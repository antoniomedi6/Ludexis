<?php

namespace App\Livewire\Vistas;

use App\Models\Game;
use Livewire\Component;

class ShowGame extends Component
{
    public Game $game;

    public function mount(Game $game)
    {
        $this->game = $game->load(['genres', 'platforms', 'companies']);
    }

    public function render()
    {
        return view('livewire.vistas.show-game');
    }
}