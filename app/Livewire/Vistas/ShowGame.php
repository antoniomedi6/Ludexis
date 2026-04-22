<?php

namespace App\Livewire\Vistas;

use App\Models\Game;
use App\Models\GameUser;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ShowGame extends Component
{
    public Game $game;
    public float $averageHours = 0;
    public int $totalRecords = 0;

    public function mount(Game $game)
    {
        $this->game = $game->load(['genres', 'platforms', 'companies']);

        // Guardamos media y total en la misma caché
        $stats = Cache::remember("game_{$game->id}_time_stats", now()->addHours(24), function () use ($game) {
            $q = GameUser::where('game_id', $game->id)->where('hours_finish', '>', 0);

            return [
                'average' => round($q->avg('hours_finish') ?? 0, 1),
                'count' => $q->count()
            ];
        });

        $this->averageHours = $stats['average'];
        $this->totalRecords = $stats['count'];
    }

    public function render()
    {
        return view('livewire.vistas.show-game');
    }
}