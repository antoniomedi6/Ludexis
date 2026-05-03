<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Company;
use Carbon\Carbon;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;

/**
 * Action que se encarga de obtener y guardar un videojuego en el sistema.
 * Verifica si el juego existe en la base de datos local mediante su slug;
 * en caso negativo, realiza una petición a la API de IGDB, formatea la información
 * y crea el registro sincronizando sus relaciones (géneros, compañías y plataformas).
 */
class SaveGameAction
{
    public function __invoke(string $slug): ?Game
    {
        // COMPROBACIÓN LOCAL
        $localGame = $this->findLocalGame($slug);

        if ($localGame) {
            return $localGame;
        }

        // PETICIÓN A IGDB
        $igdbGame = $this->fetchFromIgdb($slug);

        if (!$igdbGame) {
            return null;
        }

        // FORMATEO DE DATOS
        $coverUrl = $this->resolveCoverUrl($igdbGame);

        if (!$coverUrl) {
            return null;
        }

        // CREACIÓN DEL JUEGO
        $game = $this->createGameFromIgdb($igdbGame, $coverUrl);

        // SINCRONIZACIÓN DE GÉNEROS
        $this->syncGenres($game, $igdbGame);

        // SINCRONIZACIÓN DE COMPAÑÍAS
        $this->syncCompanies($game, $igdbGame);

        // SINCRONIZACIÓN DE PLATAFORMAS
        $this->syncPlatforms($game, $igdbGame);

        return $game;
    }

    private function findLocalGame(string $slug): ?Game
    {
        return Game::where('slug', $slug)->first();
    }

    private function fetchFromIgdb(string $slug): ?IGDBGame
    {
        return IGDBGame::select([
            'id',
            'name',
            'summary',
            'first_release_date',
            'slug',
            'total_rating'
        ])
            ->with([
                'videos' => ['video_id', 'name'],
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name', 'slug', 'abbreviation'],
                'platforms.platform_family' => ['name'],
                'platforms.platform_logo' => ['url'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name', 'slug', 'description', 'country', 'start_date'],
                'screenshots' => ['image_id']
            ])
            ->where('slug', $slug)
            ->whereHas('cover')
            ->first();
    }

    private function resolveCoverUrl(IGDBGame $igdbGame): ?string
    {
        $url = data_get($igdbGame, 'cover.url');
        if (!$url) {
            return null;
        }

        return str_replace('t_thumb', 't_cover_big', $url);
    }

    private function formatIgdbDateValue(mixed $value): ?string
    {
        if (!$value) {
            return null;
        }

        return is_numeric($value)
            ? Carbon::createFromTimestamp($value)->format('Y-m-d')
            : Carbon::parse($value)->format('Y-m-d');
    }

    private function resolveTrailerVideoUrl(IGDBGame $igdbGame): ?string
    {
        $videos = data_get($igdbGame, 'videos', []);
        if (empty($videos)) {
            return null;
        }

        foreach ($videos as $video) {
            if (isset($video['video_id'], $video['name']) && stripos($video['name'], 'trailer') !== false) {
                return 'https://www.youtube.com/embed/' . $video['video_id'];
            }
        }

        return null;
    }

    private function collectScreenshotHashes(IGDBGame $igdbGame): array
    {
        $screenshotHashes = [];
        $screenshotsData = data_get($igdbGame, 'screenshots', []);
        if (empty($screenshotsData)) {
            return $screenshotHashes;
        }

        foreach ($screenshotsData as $screenshot) {
            if (isset($screenshot['image_id'])) {
                $screenshotHashes[] = $screenshot['image_id'];
            }
        }

        return $screenshotHashes;
    }

    private function createGameFromIgdb(IGDBGame $igdbGame, string $coverUrl): Game
    {
        $formattedDate = $this->formatIgdbDateValue(data_get($igdbGame, 'first_release_date'));
        $igdbRating = $igdbGame->total_rating ?? 0;
        $screenshotHashes = $this->collectScreenshotHashes($igdbGame);

        return Game::create([
            'igdb_id' => $igdbGame->id,
            'title' => $igdbGame->name,
            'synopsis' => data_get($igdbGame, 'summary', ''),
            'cover_url' => $coverUrl,
            'first_release_date' => $formattedDate,
            'slug' => $igdbGame->slug,
            'rating' => $igdbRating,
            'igdb_rating' => $igdbRating,
            'avg_time' => 0,
            'video_url' => $this->resolveTrailerVideoUrl($igdbGame),
            'screenshots' => !empty($screenshotHashes) ? $screenshotHashes : null
        ]);
    }

    private function syncGenres(Game $game, IGDBGame $igdbGame): void
    {
        $genres = data_get($igdbGame, 'genres', []);
        if (empty($genres)) {
            return;
        }

        $genreIds = [];
        foreach ($genres as $genreData) {
            $genreName = data_get($genreData, 'name');
            if ($genreName) {
                $genre = Genre::firstOrCreate(['name' => $genreName]);
                $genreIds[] = $genre->id;
            }
        }
        $game->genres()->sync($genreIds);
    }

    private function syncCompanies(Game $game, IGDBGame $igdbGame): void
    {
        $companies = data_get($igdbGame, 'involved_companies', []);
        if (empty($companies)) {
            return;
        }

        $companiesPivotData = [];
        foreach ($companies as $involvedCompany) {
            $companyData = data_get($involvedCompany, 'company');
            $companyName = data_get($companyData, 'name');
            $companySlug = data_get($companyData, 'slug');

            if (!$companyName || !$companySlug) {
                continue;
            }

            $startDate = data_get($companyData, 'start_date');
            $compFormattedDate = $this->formatIgdbDateValue($startDate);

            $company = Company::updateOrCreate(
                ['slug' => $companySlug],
                [
                    'name' => $companyName,
                    'description' => data_get($companyData, 'description'),
                    'country' => data_get($companyData, 'country'),
                    'start_date' => $compFormattedDate,
                ]
            );

            $companiesPivotData[$company->id] = [
                'is_developer' => data_get($involvedCompany, 'developer', false),
                'is_publisher' => data_get($involvedCompany, 'publisher', false),
            ];
        }

        $game->companies()->sync($companiesPivotData);
    }

    private function syncPlatforms(Game $game, IGDBGame $igdbGame): void
    {
        $platforms = data_get($igdbGame, 'platforms', []);
        if (empty($platforms)) {
            return;
        }

        $platformIds = [];
        foreach ($platforms as $platformData) {
            $platformName = data_get($platformData, 'name');
            if ($platformName) {
                $platform = Platform::updateOrCreate(
                    ['name' => $platformName],
                    [
                        'platform_family_name' => data_get($platformData, 'platform_family.name'),
                        'platform_logo_url' => data_get($platformData, 'platform_logo.url'),
                        'slug' => data_get($platformData, 'slug'),
                        'abbreviation' => data_get($platformData, 'abbreviation'),
                    ]
                );
                $platformIds[] = $platform->id;
            }
        }
        $game->platforms()->sync($platformIds);
    }
}
