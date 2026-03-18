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
            $igdbGames = IGDBGame::select(['id', 'name', 'first_release_date', 'total_rating', 'slug'])
                ->with(['cover' => ['url']])
                ->search($this->search)
                ->where('game_type', 0)
                ->limit(5)
                ->get();

            $games = $igdbGames->map(function ($igdbGame) {
                $coverUrl = null;
                $url = data_get($igdbGame, 'cover.url');

                if ($url) {
                    $coverUrl = str_replace('t_thumb', 't_cover_big', $url);
                }

                $releaseDate = data_get($igdbGame, 'first_release_date');

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
            });
        }

        return view('livewire.utils.search-games', compact('games'));
    }
}