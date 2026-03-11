<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Console\Command;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;

class ImportPopularGames extends Command
{
    protected $signature = 'igdb:import-popular {limit=100}';
    protected $description = 'Importa los juegos más populares desde IGDB';

    public function handle()
    {
        $limit = $this->argument('limit');
        $this->info("Importando {$limit} juegos populares...");

        $igdbGames = IGDBGame::select([
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
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name', 'slug', 'description', 'country', 'start_date']
            ])
            ->where('game_type', 0)
            ->whereHas('cover')
            ->orderBy('hypes', 'desc')
            ->limit($limit)
            ->get();
        // dd($igdbGames->toArray());
        if ($igdbGames->isEmpty()) {
            $this->error('No se pudo importar ningún juego. Revisa tu conexión y credenciales.');
            return;
        }

        $bar = $this->output->createProgressBar(count($igdbGames));
        $bar->start();

        foreach ($igdbGames as $igdbGame) {
            $coverUrl = null;
            $url = data_get($igdbGame, 'cover.url');

            if ($url) {
                $coverUrl = str_replace('t_thumb', 't_cover_big', $url);
            }

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
                    'igdb_avg_time' => 0,
                    'community_avg_time' => 0,
                    'weighted_score' => 0,
                ]
            );

            $genres = data_get($igdbGame, 'genres', []);
            if (!empty($genres)) {
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

            $companies = data_get($igdbGame, 'involved_companies', []);
            if (!empty($companies)) {
                $companiesPivotData = [];
                foreach ($companies as $involvedCompany) {
                    $companyData = data_get($involvedCompany, 'company');

                    $companyName = data_get($companyData, 'name');
                    $companySlug = data_get($companyData, 'slug');

                    if ($companyName && $companySlug) {
                        $startDate = data_get($companyData, 'start_date');
                        $formattedDate = null;

                        if ($startDate) {
                            $formattedDate = is_numeric($startDate)
                                ? \Carbon\Carbon::createFromTimestamp($startDate)->format('Y-m-d')
                                : \Carbon\Carbon::parse($startDate)->format('Y-m-d');
                        }

                        $company = \App\Models\Company::updateOrCreate(
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
                }
                $game->companies()->sync($companiesPivotData);
            }

            $platforms = data_get($igdbGame, 'platforms', []);
            if (!empty($platforms)) {
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

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Importación completada.');
    }
}