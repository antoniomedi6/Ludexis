<?php

namespace App\Livewire\Utils;

use App\Models\Game;
use Livewire\Component;

class SearchGames extends Component
{
    public string $search = '';

    public function render()
    {
        $games = collect();

        if (strlen($this->search) >= 2) {
            $games = Game::select('games.cover_url', 'games.title', 'games.rating', 'games.slug', 'games.first_release_date')
                ->where('games.title', 'like', "%{$this->search}%")
                ->orderBy('games.rating', 'desc')
                ->limit(5)
                ->get();
        }

        return view('livewire.utils.search-games', compact('games'));
    }
}