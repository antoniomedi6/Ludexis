<?php

namespace App\Livewire\Utils;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PreviewMyRecentActivity extends Component
{
    public int $limit = 5;

    public function render()
    {
        $activities = collect();

        $activities = Activity::with(['game:id,title,cover_url,slug'])
            ->where('user_id', Auth::id())
            ->latest()
            ->limit($this->limit)
            ->get();

        return view('livewire.utils.preview-my-recent-activity', compact('activities'));
    }
}
