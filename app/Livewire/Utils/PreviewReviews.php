<?php

namespace App\Livewire\Utils;

use App\Models\GameUser;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PreviewReviews extends Component
{
    public function render()
    {
        $lastReviews = Cache::remember('last_reviews', 300, function () {
            return GameUser::with(['user:id,name,role', 'game:id,title,cover_url,slug'])
                ->whereNotNull('review')
                ->latest()
                ->limit(3)
                ->get(['id', 'rating', 'review', 'user_id', 'game_id', 'created_at']);
        });
        return view('livewire.utils.preview-reviews', compact('lastReviews'));
    }
}