<?php

namespace App\Livewire\Vistas;

use App\Models\Game;
use App\Models\GameUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class FeedSocial extends Component
{
    public int $limit = 10;

    public string $feedTab = 'relevant';

    public function render(): View
    {
        $countQuery = GameUser::query()
            ->with(['user', 'game'])
            ->whereNotNull('review')
            ->where('review', '!=', '')
            ->whereHas('game')
            ->whereHas('user', fn($q) => $q->whereNull('banned_at'));

        $userReviewsQuery = GameUser::query()
            ->with(['user', 'game'])
            ->whereNotNull('review')
            ->where('review', '!=', '')
            ->whereHas('game')
            ->whereHas('user', fn($q) => $q->whereNull('banned_at'));

        if ($this->feedTab === 'followings') {
            $followingUserIds = Auth::user()
                ->approvedFollowings()
                ->where('followable_type', User::class)
                ->select('followable_id');

            $countQuery->whereIn('user_id', $followingUserIds);
            $userReviewsQuery->whereIn('user_id', $followingUserIds);
        }

        $totalCount = $countQuery->count();

        if ($this->feedTab === 'relevant') {
            $userReviewsQuery
                ->withCount('likes')
                ->orderByDesc('likes_count')
                ->orderByDesc('created_at');
        } else {
            $userReviewsQuery->orderByDesc('created_at');
        }

        $userReviews = $userReviewsQuery
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

        return view('livewire.vistas.feed-social', compact('userReviews', 'totalCount', 'trending'));
    }

    public function setFeedTab(string $tab): void
    {
        $this->feedTab = $tab;
        $this->limit = 10;
    }

    public function loadMore(): void
    {
        $this->limit += 10;
    }

}
