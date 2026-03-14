<?php

namespace App\Livewire\Utils;

use App\Models\Game;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;

class Tendencias extends Component
{
    public function render()
    {
        $popularGames = Cache::remember('popular_games_weekly', 3600, function () {
            $igdbGames = IGDBGame::select(['id', 'name', 'total_rating', 'slug', 'hypes'])
                ->with(['cover' => ['url']])
                ->where('first_release_date', '>=', now()->subMonths(3)->timestamp)
                ->where('first_release_date', '<=', now()->timestamp)
                ->where('total_rating_count', '>', 0)
                ->orderBy('hypes', 'desc')
                ->limit(5)
                ->get();

            return $igdbGames->map(function ($igdbGame) {
                $coverUrl = null;
                $url = data_get($igdbGame, 'cover.url');

                if ($url) {
                    $coverUrl = str_replace('t_thumb', 't_cover_big', $url);
                }

                $placeholder = new Game();
                $placeholder->igdb_id = $igdbGame->id;
                $placeholder->title = $igdbGame->name;
                $placeholder->cover_url = $coverUrl;
                $placeholder->rating = $igdbGame->total_rating ?? 0;
                $placeholder->slug = $igdbGame->slug;

                return $placeholder;
            });
        });

        return view('livewire.utils.tendencias', compact('popularGames'));
    }
}