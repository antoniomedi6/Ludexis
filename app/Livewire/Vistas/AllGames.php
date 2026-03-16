<?php

namespace App\Livewire\Vistas;

use App\Actions\SaveGameAction;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;

class AllGames extends Component
{
    use WithPagination;

    public string $orderBy = 'first_release_date';
    public array $platformsFilter = [];
    public int $minRatingFilter = 0;
    public array $genresFilter = [];
    public int $limit = 48;

    public function render()
    {
        $page = $this->getPage();

        $query = IGDBGame::select([
            'id',
            'name',
            'first_release_date',
            'total_rating',
            'total_rating_count',
            'game_type',
            'slug'
        ])
            ->with([
                'cover' => ['url'],
                'genres' => ['name'],
                'platforms' => ['name'],
                'involved_companies' => ['developer', 'publisher'],
                'involved_companies.company' => ['name']
            ])
            ->where('total_rating', '>=', $this->minRatingFilter)
            ->where('total_rating_count', '>=', 30)
            ->where('game_type', '=', 0);

        if (!empty($this->platformsFilter)) {
            $platformNames = Platform::whereIn('id', $this->platformsFilter)->pluck('name')->toArray();
            $query->whereIn('platforms.name', $platformNames);
        }

        if (!empty($this->genresFilter)) {
            $genreNames = Genre::whereIn('id', $this->genresFilter)->pluck('name')->toArray();
            $query->whereIn('genres.name', $genreNames);
        }

        $total = (clone $query)->count();

        $sortField = $this->orderBy === 'rating' ? 'total_rating' : $this->orderBy;

        $igdbGames = $query->orderBy($sortField, 'desc')
            ->skip(($page - 1) * $this->limit)
            ->take($this->limit)
            ->get();

        $igdbIds = $igdbGames->pluck('id')->toArray();

        $localGames = Game::with(['genres', 'platforms', 'companies'])
            ->whereIn('igdb_id', $igdbIds)
            ->get()
            ->keyBy('igdb_id');

        $mergedGames = $igdbGames->map(function ($igdbGame) use ($localGames) {
            if ($localGames->has($igdbGame->id)) {
                $local = $localGames->get($igdbGame->id);
                $local->is_local = true;

                return $local;
            }

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
            $placeholder->is_local = false;

            $releaseDate = data_get($igdbGame, 'first_release_date');
            if ($releaseDate) {
                $placeholder->first_release_date = is_numeric($releaseDate)
                    ? Carbon::createFromTimestamp($releaseDate)
                    : Carbon::parse($releaseDate);
            }

            $genres = collect(data_get($igdbGame, 'genres', []))->map(function ($g) {
                $genre = new Genre();
                $genre->name = data_get($g, 'name');
                return $genre;
            });
            $placeholder->setRelation('genres', $genres);

            $platforms = collect(data_get($igdbGame, 'platforms', []))->map(function ($p) {
                $platform = new Platform();
                $platform->name = data_get($p, 'name');
                return $platform;
            });
            $placeholder->setRelation('platforms', $platforms);

            $companies = collect(data_get($igdbGame, 'involved_companies', []))->map(function ($ic) {
                $company = new \App\Models\Company();
                $company->name = data_get($ic, 'company.name');
                return $company;
            })->filter(function ($c) {
                return !empty($c->name);
            });
            $placeholder->setRelation('companies', $companies);

            return $placeholder;
        });

        $games = new LengthAwarePaginator(
            $mergedGames,
            $total,
            $this->limit,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $allPlatforms = Platform::orderBy('name', 'desc')->get();
        $topGenres = Genre::withCount(['games'])
            ->orderBy('games_count', 'desc')
            ->limit(5)
            ->get();
        $otherGenres = Genre::withCount(['games'])
            ->whereNotIn('id', $topGenres->pluck('id'))
            ->get();

        return view('livewire.vistas.all-games', compact('games', 'allPlatforms', 'topGenres', 'otherGenres'));
    }

    public function clearFilters()
    {
        $this->reset(['platformsFilter', 'genresFilter', 'minRatingFilter']);
    }

    public function loadMore()
    {
        $this->limit += 48;
    }

    public function addToDb(string $slug)
    {
        $saveGameAction = new SaveGameAction();

        $game = $saveGameAction($slug);

        if (!$game) {
            return;
        }

        $this->redirect(route('games.show', $game->slug));
    }
}