<?php

namespace App\Livewire\Utils;

use App\Models\Review;
use Cache;
use Livewire\Component;

class PreviewReviews extends Component
{
    public function render()
    {
        $lastReviews = Cache::remember('ultimas_reseñas', 300, function () {
            return Review::with(['user:id,name,role', 'game:id,title,cover_image'])
                ->latest()
                ->limit(3)
                ->get(['id', 'score', 'body', 'user_id', 'game_id', 'created_at']);
        });
        return view('livewire.utils.preview-reviews', compact('lastReviews'));
    }
}