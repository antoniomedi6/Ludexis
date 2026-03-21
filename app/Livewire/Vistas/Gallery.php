<?php

namespace App\Livewire\Vistas;

use App\Models\Game;
use App\Models\Image;
use Livewire\Component;

class Gallery extends Component
{
    public ?Game $game = null;

    public array $gamesFilter = [];
    public string $spoilerFilter = 'all';
    public string $dateFilter = 'all';
    public string $orderBy = 'created_at';

    public function mount($slug = null)
    {
        if ($slug) {
            $this->game = Game::where('slug', $slug)->firstOrFail();
        }
    }

    public function clearFilters()
    {
        $this->gamesFilter = [];
        $this->spoilerFilter = 'all';
        $this->dateFilter = 'all';
        $this->orderBy = 'created_at';
    }

    public function render()
    {
        $query = Image::with(['game', 'user']);

        if ($this->game) {
            $query->where('game_id', $this->game->id);
        }

        if (!empty($this->gamesFilter)) {
            $query->whereIn('game_id', $this->gamesFilter);
        }

        if ($this->spoilerFilter === 'hide') {
            $query->where('is_spoiler', false);
        } elseif ($this->spoilerFilter === 'only') {
            $query->where('is_spoiler', true);
        }

        if ($this->dateFilter === '24h') {
            $query->where('created_at', '>=', now()->subDay());
        } elseif ($this->dateFilter === 'week') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($this->dateFilter === 'month') {
            $query->where('created_at', '>=', now()->subMonth());
        }

        if ($this->orderBy === 'likes') {
            $query->withCount('likes')->orderByDesc('likes_count');
        } else {
            $query->latest();
        }

        $images = $query->get();
        $allGames = Game::has('images')->orderBy('title')->get();
        $game = $this->game;

        return view('livewire.vistas.gallery', compact('images', 'game', 'allGames'));
    }
}