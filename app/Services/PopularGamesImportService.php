<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Services\GameScoreService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;
use MarcReichel\IGDBLaravel\Models\Genre as IGDBGenre;
use MarcReichel\IGDBLaravel\Models\Platform as IGDBPlatform;

/**
 * Servicio para importar juegos populares desde IGDB.
 * Sincroniza metadatos (géneros y plataformas) y crea/actualiza juegos con sus relaciones.
 */
class PopularGamesImportService
{
    // SINCRONIZACIÓN DE METADATOS
    public function syncGenresAndPlatforms(): void
    {
        $igdbGenres = IGDBGenre::select(['name'])->limit(500)->get();
        foreach ($igdbGenres as $igdbGenre) {
            Genre::firstOrCreate(['name' => $igdbGenre->name]);
        }

        $igdbPlatforms = IGDBPlatform::select(['name'])->limit(500)->get();
        foreach ($igdbPlatforms as $igdbPlatform) {
            Platform::firstOrCreate(['name' => $igdbPlatform->name]);
        }
    }

    // CONSULTA A IGDB
    public function fetchPopularGames(int $limit): Collection
    {
        return IGDBGame::select([
            'id',
            'name',
            'summary',
            'first_release_date',
            'game_type',
            'slug',
            'total_rating',
            'hypes',
        ])
            ->with([
                'videos' => ['video_id'],
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name', 'slug', 'description', 'country', 'start_date'],
                'screenshots' => ['image_id'],
            ])
            ->where('game_type', 0)
            ->whereHas('cover')
            ->orderBy('hypes', 'desc')
            ->limit($limit)
            ->get();
    }

    // IMPORTACIÓN PRINCIPAL
    public function importPopular(int $limit, ?callable $afterEach = null): int
    {
        $this->syncGenresAndPlatforms();

        $igdbGames = $this->fetchPopularGames($limit);

        if ($igdbGames->isEmpty()) {
            return 0;
        }

        return $this->importFromIgdbGames($igdbGames, $afterEach);
    }

    // IMPORTACIÓN DESDE LISTA YA RESUELTA
    public function importFromIgdbGames(Collection $igdbGames, ?callable $afterEach = null): int
    {
        $imported = 0;

        foreach ($igdbGames as $igdbGame) {
            $igdbRating = $igdbGame->total_rating;

            $game = Game::updateOrCreate(
                ['igdb_id' => $igdbGame->id],
                [
                    'title' => $igdbGame->name,
                    'synopsis' => data_get($igdbGame, 'summary', ''),
                    'cover_url' => $this->buildCoverUrl($igdbGame),
                    'first_release_date' => $this->formatReleaseDate(data_get($igdbGame, 'first_release_date')),
                    'slug' => $igdbGame->slug,
                    'rating' => $igdbRating,
                    'igdb_rating' => $igdbRating,
                    'avg_time' => 0,
                    'video_url' => $this->buildVideoUrl($igdbGame),
                    'screenshots' => $this->buildScreenshotHashes($igdbGame),
                ]
            );

            $this->syncGenres($game, data_get($igdbGame, 'genres', []));
            $this->syncCompanies($game, data_get($igdbGame, 'involved_companies', []));
            $this->syncPlatforms($game, data_get($igdbGame, 'platforms', []));

            app(GameScoreService::class)->recalculate($game->refresh());

            $imported++;

            if ($afterEach) {
                $afterEach($igdbGame, $game);
            }
        }

        return $imported;
    }

    // HELPERS DE MAPEO
    private function buildCoverUrl($igdbGame): ?string
    {
        $url = data_get($igdbGame, 'cover.url');

        if (!$url) {
            return null;
        }

        return str_replace('t_thumb', 't_cover_big', $url);
    }

    private function formatReleaseDate($releaseDate): ?string
    {
        return $releaseDate ? $releaseDate->format('Y-m-d') : null;
    }

    private function buildVideoUrl($igdbGame): ?string
    {
        $videos = data_get($igdbGame, 'videos', []);

        if (empty($videos) || !isset($videos[0]['video_id'])) {
            return null;
        }

        return 'https://www.youtube.com/embed/' . $videos[0]['video_id'];
    }

    private function buildScreenshotHashes($igdbGame): ?array
    {
        $screenshotsData = data_get($igdbGame, 'screenshots', []);

        if (empty($screenshotsData)) {
            return null;
        }

        $screenshotHashes = [];

        foreach ($screenshotsData as $screenshot) {
            if (isset($screenshot['image_id'])) {
                $screenshotHashes[] = $screenshot['image_id'];
            }
        }

        return !empty($screenshotHashes) ? $screenshotHashes : null;
    }

    // SINCRONIZACIÓN DE RELACIONES
    private function syncGenres(Game $game, array|Collection $genres): void
    {
        if ($genres instanceof Collection) {
            $genres = $genres->all();
        }

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

    private function syncPlatforms(Game $game, array|Collection $platforms): void
    {
        if ($platforms instanceof Collection) {
            $platforms = $platforms->all();
        }

        if (empty($platforms)) {
            return;
        }

        $platformIds = [];

        foreach ($platforms as $platformData) {
            $platformName = data_get($platformData, 'name');
            if ($platformName) {
                $platform = Platform::firstOrCreate(['name' => $platformName]);
                $platformIds[] = $platform->id;
            }
        }

        $game->platforms()->sync($platformIds);
    }

    private function syncCompanies(Game $game, array|Collection $companies): void
    {
        if ($companies instanceof Collection) {
            $companies = $companies->all();
        }

        if (empty($companies)) {
            return;
        }

        $companiesPivotData = [];

        foreach ($companies as $involvedCompany) {
            $company = $this->upsertCompany(data_get($involvedCompany, 'company'));

            if (!$company) {
                continue;
            }

            $companiesPivotData[$company->id] = [
                'is_developer' => data_get($involvedCompany, 'developer', false),
                'is_publisher' => data_get($involvedCompany, 'publisher', false),
            ];
        }

        $game->companies()->sync($companiesPivotData);
    }

    // UPSERTS
    private function upsertCompany($companyData): ?Company
    {
        $companyName = data_get($companyData, 'name');
        $companySlug = data_get($companyData, 'slug');

        if (!$companyName || !$companySlug) {
            return null;
        }

        $startDate = data_get($companyData, 'start_date');
        $formattedDate = null;

        if ($startDate) {
            $formattedDate = is_numeric($startDate)
                ? Carbon::createFromTimestamp($startDate)->format('Y-m-d')
                : Carbon::parse($startDate)->format('Y-m-d');
        }

        return Company::updateOrCreate(
            ['slug' => $companySlug],
            [
                'name' => $companyName,
                'description' => data_get($companyData, 'description'),
                'country' => data_get($companyData, 'country'),
                'start_date' => $formattedDate,
            ]
        );
    }
}
