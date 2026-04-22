<?php

namespace App\Livewire\Vistas;

use App\Models\Game;
use App\Models\GameUser;
use Livewire\Component;

class FeedSocial extends Component
{
    public int $limit = 10;

    public function loadMore(): void
    {
        $this->limit += 10;
    }

    public function render()
    {
        $baseQuery = GameUser::query()
            ->with(['user', 'game'])
            ->whereNotNull('review')
            ->where('review', '!=', '')
            ->whereHas('game')
            ->whereHas('user', fn($q) => $q->whereNull('banned_at'));

        $totalCount = (clone $baseQuery)->count();

        $userReviews = $baseQuery
            ->orderByDesc('created_at')
            ->limit($this->limit)
            ->get();

        $trending = Game::query()
            ->withCount([
                'users as reviews_count' => fn($q) => $q->whereNotNull('game_user.review')
                    ->where('game_user.review', '!=', ''),
            ])
            ->having('reviews_count', '>', 0)
            ->orderByDesc('reviews_count')
            ->orderByDesc('rating')
            ->limit(5)
            ->get();

        return view('livewire.vistas.feed-social', [
            'userReviews' => $userReviews,
            'totalCount' => $totalCount,
            'trending' => $trending,
        ]);
    }
}
