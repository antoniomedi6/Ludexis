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

        $igdbGames = IGDBGame::with(['genres', 'platforms'])
            ->select(['name', 'summary', 'cover.url', 'multiplayer_modes'])
            ->where('game_type', 0)
            ->whereNotNull('cover.url')
            ->orderBy('total_rating_count', 'desc')
            ->limit($limit)
            ->get();

        if ($igdbGames->isEmpty()) {
            $this->warn('No se encontraron juegos. Probando sin filtro de carátula...');
        }

        if ($igdbGames->isEmpty()) {
            $this->error('No se pudo importar ningún juego. Revisa tu conexión y credenciales.');
            return;
        }

        $bar = $this->output->createProgressBar(count($igdbGames));
        $bar->start();

        foreach ($igdbGames as $igdbGame) {
            // Guardar juego
            $game = Game::updateOrCreate(
                ['igdb_id' => $igdbGame->id],
                [
                    'title' => $igdbGame->name,
                    'synopsis' => $igdbGame->summary ?? '',
                    'cover_url' => $igdbGame->cover->url ?? null,
                    'is_multiplayer' => $igdbGame->multiplayer_modes ? true : false,
                    'igdb_avg_time' => 0,
                    'community_avg_time' => 0,
                    'weighted_score' => 0,
                ]
            );

            // Sincronizar géneros
            if ($igdbGame->genres->isNotEmpty()) {
                $genreIds = [];
                foreach ($igdbGame->genres as $genreData) {
                    $genre = Genre::firstOrCreate(['name' => $genreData->name]);
                    $genreIds[] = $genre->id;
                }
                $game->genres()->sync($genreIds);
            }

            // Sincronizar plataformas
            if ($igdbGame->platforms->isNotEmpty()) {
                $platformIds = [];
                foreach ($igdbGame->platforms as $platformData) {
                    $platform = Platform::firstOrCreate(['name' => $platformData->name]);
                    $platformIds[] = $platform->id;
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