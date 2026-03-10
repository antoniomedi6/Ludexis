<?php

namespace App\Livewire\Vistas;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Livewire\Component;
use Livewire\WithPagination;

class AllGames extends Component
{
    use WithPagination;
    public string $orderBy = 'rating';
    public array $platformsFilter = [];
    public array $genresFilter = [];

    public function render()
    {
        $query = Game::with(['genres', 'platforms'])
            ->select([
                'id',
                'cover_url',
                'title',
                'first_release_date',
                'weighted_score',
                'rating',
                'slug'
            ]);

        if (!empty($this->platformsFilter)) {
            $query->whereHas('platforms', function ($q) {
                $q->whereIn('platforms.id', $this->platformsFilter);
            });
        }

        if (!empty($this->genresFilter)) {
            foreach ($this->genresFilter as $genreId) {
                $query->whereHas('genres', function ($q) use ($genreId) {
                    $q->where('genres.id', $genreId);
                });
            }
        }

        $allGames = $query->orderBy($this->orderBy, 'desc')
            ->paginate(48);
        // dd($allGames->toArray());

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

    public function clearFilters()
    {
        $this->reset(['platformsFilter', 'genresFilter']);
    }
}