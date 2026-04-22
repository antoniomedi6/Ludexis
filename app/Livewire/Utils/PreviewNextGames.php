<?php

namespace App\Livewire\Utils;

use App\Models\Game;
use Livewire\Component;

class PreviewNextGames extends Component
{
    public function render()
    {
        $nextGames = Game::where(function ($q) {
            $q->where('first_release_date', '>=', now())
                ->orWhereNull('first_release_date');
        })
            ->orderByRaw('first_release_date IS NULL')
            ->orderBy('first_release_date', 'asc')
            ->take(5)
            ->get();
        return view('livewire.utils.preview-next-games', compact('nextGames'));
    }
}