<?php

namespace App\Livewire\Vistas;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AllGames extends Component
{
    use WithPagination;
    public string $orderBy = 'rating';
    public function render()
    {
        $allGames = Game::with(['genres', 'platforms'])
            ->select([
                'id',
                'cover_url',
                'title',
                'first_release_date',
                'rating',
                'weighted_score',
                'slug'
            ])
            ->orderBy($this->orderBy, 'desc')
            ->paginate(24);
        $allPlatforms = Platform::orderBy('name', 'desc')->get();
        $topGenres = Genre::withCount(['games'])
            ->orderBy('games_count', 'desc')
            ->limit(5)
            ->get();
        $otherGenres = Genre::withCount(['games'])
            ->whereNotIn('id', $topGenres->pluck('id'))
            ->get();
        return view('livewire.vistas.all-games', compact('allGames', 'allPlatforms', 'topGenres', 'otherGenres'));
    }
}