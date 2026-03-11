<?php

namespace App\Livewire\Utils;

use App\Models\Game;
use Cache;
use Livewire\Component;

class Tendencias extends Component
{
    public function render()
    {
        $popularGames = Cache::remember('popular_games_weekly', 3600, function () {
            return Game::select('games.id', 'games.title', 'games.cover_url', 'games.rating')
                ->join('game_user', 'games.id', '=', 'game_user.game_id')
                ->where('game_user.created_at', '>=', now()->subWeek())
                ->groupBy('games.id', 'games.title', 'games.cover_url', 'games.rating')
                ->orderByRaw('COUNT(game_user.game_id) DESC')
                ->limit(5)
                ->get();
        });

        //dd($popularGames->toArray());
        return view('livewire.utils.tendencias', compact('popularGames'));
    }
}