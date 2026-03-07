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
        ])
            ->with([
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name'],
            ])
            ->where('game_type', 0)
            ->whereHas('cover')
            ->orderBy('total_rating_count', 'desc')
            ->limit($limit)
            ->get();

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
                    'rating' => data_get($igdbGame, 'total_rating', 0),
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