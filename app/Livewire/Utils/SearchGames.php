<?php

namespace App\Livewire\Utils;

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

        if (strlen($this->search) >= 2) {
            $igdbGames = IGDBGame::where('name', 'ilike', '%' . $this->search . '%')
                ->orderBy('total_rating', 'desc')
                ->select(['id', 'name', 'first_release_date', 'total_rating', 'slug', 'category'])
                ->with(['cover' => ['image_id', 'url']])
                ->limit(10)
                ->get();

            $games = $igdbGames
                ->filter(function ($igdbGame) {
                    return in_array($igdbGame->category ?? 0, [0, 8, 9]);
                })
                ->take(5)
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

                    $releaseDate = $igdbGame->first_release_date ?? null;

                    $placeholder = new Game();
                    $placeholder->igdb_id = $igdbGame->id;
                    $placeholder->title = $igdbGame->name;
                    $placeholder->cover_url = $coverUrl;
                    $placeholder->rating = $igdbGame->total_rating ?? 0;
                    $placeholder->slug = $igdbGame->slug;

                    if ($releaseDate) {
                        $placeholder->first_release_date = is_numeric($releaseDate)
                            ? Carbon::createFromTimestamp($releaseDate)
                            : Carbon::parse($releaseDate);
                    }

                    return $placeholder;
                })->values(); // Reindexar la colección
        }

        return view('livewire.utils.search-games', compact('games'));
    }
}