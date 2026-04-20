<?php

namespace App\Livewire\Vistas;

use App\Livewire\Forms\ImageForm;
use App\Models\Game;
use App\Models\Image;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
class Gallery extends Component
{
    use WithFileUploads;

    public ?Game $game = null;
    public ImageForm $cimage;
    public bool $showingModal = false;

    public array $gamesFilter = [];
    public string $spoilerFilter = '';
    public string $dateFilter = '';
    public string $orderBy = 'created_at';
    public int $limit = 30;

    public function mount($slug = null)
    {
        if ($slug) {
            $this->game = Game::where('slug', $slug)->firstOrFail();
            $this->cimage->game_id = $this->game->id;
        }
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

        $images = $query->limit($this->limit)->get();

        $gamesWithImages = Game::has('images')->orderBy('title')->get();

        $allGames = Game::orderBy('title')->get();

        $game = $this->game;

        return view('livewire.vistas.gallery', compact('images', 'game', 'gamesWithImages', 'allGames'));
    }

    public function save()
    {
        $this->cimage->saveForm();
        $this->showingModal = false;
        $this->dispatch('notify', message: 'Imagen Subida Correctamente', type: 'success');
    }

    public function cancel()
    {
        $this->cimage->cancelForm();
        $this->showingModal = false;
    }


    public function clearFilters()
    {
        $this->gamesFilter = [];
        $this->spoilerFilter = 'all';
        $this->dateFilter = 'all';
        $this->orderBy = 'created_at';
    }

    public function loadMore()
    {
        $this->limit += 30;
    }
}