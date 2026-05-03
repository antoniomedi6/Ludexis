<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;
use MarcReichel\IGDBLaravel\Models\Genre as IGDBGenre;
use MarcReichel\IGDBLaravel\Models\Platform as IGDBPlatform;

class ImportPopularGames extends Command
{
    protected $signature = 'igdb:import-popular {limit=100}';
    protected $description = 'Importa los juegos más populares desde IGDB';

    public function handle()
    {
        $this->info("Sincronizando metadatos (Géneros y Plataformas)...");

        $this->syncGenresFromIgdb();
        $this->syncPlatformsFromIgdb();

        $limit = $this->argument('limit');
        $this->info("Importando {$limit} juegos populares...");

        $igdbGames = $this->fetchPopularIgdbGames($limit);

        if ($igdbGames->isEmpty()) {
            $this->error('No se pudo importar ningún juego. Revisa tu conexión y credenciales.');
            return;
        }

        $bar = $this->output->createProgressBar(count($igdbGames));
        $bar->start();

        foreach ($igdbGames as $igdbGame) {
            $this->importIgdbGame($igdbGame);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Importación completada.');
    }

    private function syncGenresFromIgdb(): void
    {
        $igdbGenres = IGDBGenre::select(['name'])->limit(500)->get();
        foreach ($igdbGenres as $igdbGenre) {
            Genre::firstOrCreate(['name' => $igdbGenre->name]);
        }
    }

    private function syncPlatformsFromIgdb(): void
    {
        $igdbPlatforms = IGDBPlatform::select(['name', 'slug', 'abbreviation'])
            ->with([
                'platform_family' => ['name'],
                'platform_logo' => ['url'],
            ])
            ->limit(500)
            ->get();
        foreach ($igdbPlatforms as $igdbPlatform) {
            Platform::updateOrCreate(
                ['name' => $igdbPlatform->name],
                [
                    'platform_family_name' => data_get($igdbPlatform, 'platform_family.name'),
                    'platform_logo_url' => data_get($igdbPlatform, 'platform_logo.url'),
                    'slug' => data_get($igdbPlatform, 'slug'),
                    'abbreviation' => data_get($igdbPlatform, 'abbreviation'),
                ]
            );
        }
    }

    private function fetchPopularIgdbGames(int|string $limit): Collection
    {
        return IGDBGame::select([
            'id',
            'name',
            'summary',
            'first_release_date',
            'game_type',
            'slug',
            'total_rating',
            'hypes'
        ])
            ->with([
                'videos' => ['video_id'],
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name', 'slug', 'abbreviation'],
                'platforms.platform_family' => ['name'],
                'platforms.platform_logo' => ['url'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name', 'slug', 'description', 'country', 'start_date'],
                'screenshots' => ['image_id']
            ])
            ->where('game_type', 0)
            ->whereHas('cover')
            ->orderBy('hypes', 'desc')
            ->limit($limit)
            ->get();
    }

    private function importIgdbGame(IGDBGame $igdbGame): void
    {
        $coverUrl = $this->resolveCoverUrl($igdbGame);
        $releaseDate = data_get($igdbGame, 'first_release_date');
        $game = Game::updateOrCreate(
            ['igdb_id' => $igdbGame->id],
            [
                'title' => $igdbGame->name,
                'synopsis' => data_get($igdbGame, 'summary', ''),
                'cover_url' => $coverUrl,
                'first_release_date' => $releaseDate ? $releaseDate->format('Y-m-d') : null,
                'slug' => $igdbGame->slug,
                'rating' => $igdbGame->total_rating,
                'avg_time' => 0,
                'video_url' => $this->resolveFirstVideoEmbedUrl($igdbGame),
                'screenshots' => $this->resolveScreenshotsAttribute($igdbGame)
            ]
        );

        $this->syncGameGenres($game, $igdbGame);
        $this->syncGameCompanies($game, $igdbGame);
        $this->syncGamePlatforms($game, $igdbGame);
    }

    private function resolveCoverUrl(IGDBGame $igdbGame): ?string
    {
        $url = data_get($igdbGame, 'cover.url');
        if (!$url) {
            return null;
        }

        return str_replace('t_thumb', 't_cover_big', $url);
    }

    private function resolveFirstVideoEmbedUrl(IGDBGame $igdbGame): ?string
    {
        $videos = data_get($igdbGame, 'videos', []);
        if (empty($videos) || !isset($videos[0]['video_id'])) {
            return null;
        }

        return 'https://www.youtube.com/embed/' . $videos[0]['video_id'];
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

    private function resolveScreenshotsAttribute(IGDBGame $igdbGame): ?array
    {
        $screenshotHashes = $this->collectScreenshotHashes($igdbGame);

        return !empty($screenshotHashes) ? $screenshotHashes : null;
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

    private function syncGameGenres(Game $game, IGDBGame $igdbGame): void
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

    private function syncGameCompanies(Game $game, IGDBGame $igdbGame): void
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
            $formattedDate = $this->formatIgdbDateValue($startDate);

            $company = Company::updateOrCreate(
                ['slug' => $companySlug],
                [
                    'name' => $companyName,
                    'description' => data_get($companyData, 'description'),
                    'country' => data_get($companyData, 'country'),
                    'start_date' => $formattedDate,
                ]
            );

            $companiesPivotData[$company->id] = [
                'is_developer' => data_get($involvedCompany, 'developer', false),
                'is_publisher' => data_get($involvedCompany, 'publisher', false),
            ];
        }

        $game->companies()->sync($companiesPivotData);
    }

    private function syncGamePlatforms(Game $game, IGDBGame $igdbGame): void
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
