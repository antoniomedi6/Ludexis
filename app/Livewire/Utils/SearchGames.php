<?php

namespace App\Livewire\Utils;

use App\Actions\SaveGameAction;
use App\Models\Game;
use Carbon\Carbon;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game as IGDBGame;

class SearchGames extends Component
{
    public string $search = '';

    public function render()
    {
        $games = collect();

        if (strlen(trim($this->search)) >= 2) {
            $search = trim($this->search);

            $igdbGames = IGDBGame::where('name', 'ilike', '%' . $search . '%')
                ->where('total_rating', '>=', 0)
                ->whereIn('game_type', [0, 8, 9])
                ->whereNull('version_parent')
                ->whereHas('cover')
                ->orderBy('first_release_date', 'desc')
                ->select(['id', 'name', 'first_release_date', 'total_rating', 'slug', 'game_type'])
                ->with(['cover' => ['image_id', 'url']])
                ->limit(10)
                ->get();

            $games = $igdbGames
                ->map(function ($igdbGame) {
                    $coverUrl = null;

                    if (isset($igdbGame->cover) && isset($igdbGame->cover['image_id'])) {
                        $coverUrl = 'https://images.igdb.com/igdb/image/upload/t_cover_big/' . $igdbGame->cover['image_id'] . '.jpg';
                    } elseif (isset($igdbGame->cover) && isset($igdbGame->cover['url'])) {
                        $coverUrl = str_replace('t_thumb', 't_cover_big', $igdbGame->cover['url']);
                        if (str_starts_with($coverUrl, '//')) {
                            $coverUrl = 'https:' . $coverUrl;
                        }
                    }

                    if (!$coverUrl) {
                        return null;
                    }

                    $releaseDate = $igdbGame->first_release_date ?? null;

                    $placeholder = new Game();
                    $placeholder->igdb_id = $igdbGame->id;
                    $placeholder->title = $igdbGame->name;
                    $placeholder->cover_url = $coverUrl;
                    $placeholder->setAttribute('rating', $igdbGame->total_rating ?? 0);
                    $placeholder->slug = $igdbGame->slug;

                    if ($releaseDate) {
                        $placeholder->first_release_date = is_numeric($releaseDate)
                            ? Carbon::createFromTimestamp($releaseDate)
                            : Carbon::parse($releaseDate);
                    }

                    return $placeholder;
                })
                ->filter()
                ->take(5)
                ->values();
        }

        return view('livewire.utils.search-games', compact('games'));
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
