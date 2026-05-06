<?php

namespace App\Livewire\Utils;

use App\Models\GameUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PreviewReviews extends Component
{
    public ?int $gameId = null;
    public int $amount = 10;
    public string $sort = 'newest';
    public string $filter = 'all';

    public function mount(?int $gameId = null)
    {
        $this->gameId = $gameId;

        /* Si el usuario no esta autenticado, se muestran las reseñas más likeadas de la semana */
        if (!Auth::check()) {
            $this->sort = 'top_week';
            $this->filter = 'all';
            $this->amount = 3;
        }
    }

    public function render()
    {
        $q = GameUser::with(['user:id,name,role,profile_photo_path', 'game:id,title,cover_url,slug'])
            ->withCount('likes')
            ->whereNotNull('review');

        if ($this->gameId) {
            $q->where('game_id', $this->gameId);
        }

        // FILTROS
        match ($this->filter) {
            'positive' => $q->where('rating', '>=', 7),
            'mixed' => $q->whereBetween('rating', [4, 6]),
            'negative' => $q->where('rating', '<=', 3),
            default => null,
        };

        // ORDENACIÓN
        match ($this->sort) {
            'top_week' => $q
                ->withCount([
                    'likes as likes_week_count' => fn($likes) => $likes->where('created_at', '>=', now()->subWeek()),
                ])
                ->orderByDesc('likes_week_count')
                ->latest('updated_at'),
            'newest' => $q->latest('updated_at'),
            'oldest' => $q->oldest('updated_at'),
            'highest' => $q->orderByDesc('rating')->latest('updated_at'),
            'lowest' => $q->orderBy('rating')->latest('updated_at'),
            default => $q->latest('updated_at'),
        };

        $totalCount = $q->count();
        $reviews = $q->limit($this->amount)->get();

        if (Auth::id() && $this->sort === 'newest' && $this->filter === 'all') {
            $reviews = $reviews->sortByDesc(function ($review) {
                return $review->user_id === Auth::id();
            })->values();
        }

        return view('livewire.utils.preview-reviews', compact('reviews', 'totalCount'));
    }

    public function loadMore()
    {
        $this->amount += 10;
    }
}
