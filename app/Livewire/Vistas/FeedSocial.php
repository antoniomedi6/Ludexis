<?php

namespace App\Livewire\Vistas;

use App\Models\GameUser;
use Livewire\Component;

class FeedSocial extends Component
{
    public int $limit = 20;
    public function render()
    {
        $userReviews = GameUser::whereNotNull('review')
            ->orderBy('created_at', 'desc')
            ->limit($this->limit)
            ->get();
        return
            view('livewire.vistas.feed-social', compact('userReviews'));
    }

    public function loadMore()
    {
        $this->limit += 20;
    }
}