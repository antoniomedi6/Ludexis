<?php

namespace App\Livewire\Utils;

use App\Models\GameUser;
use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PreviewSocialFeed extends Component
{
    public function render()
    {
        $activities = Cache::remember('preview_social_feed', 60, function () {

            $reviews = GameUser::with(['user:id,name', 'game:id,title,cover_url'])
                ->whereNotNull('rating')
                ->latest('updated_at')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'review',
                        'user' => $item->user,
                        'game' => $item->game,
                        'rating' => $item->rating,
                        'review' => $item->review,
                        'date' => $item->updated_at,
                    ];
                });

            $images = Image::with(['user:id,name', 'game:id,title,cover_url'])
                ->where('is_spoiler', false)
                ->latest()
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'capture',
                        'user' => $item->user,
                        'game' => $item->game,
                        'image_path' => $item->image_path,
                        'date' => $item->created_at,
                    ];
                });

            // 3. Obtener los últimos 3 juegos añadidos a pendientes/deseados
            $wishlisted = GameUser::with(['user:id,name', 'game:id,title'])
                ->where('status', 'pending')
                ->latest('updated_at')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'wishlist',
                        'user' => $item->user,
                        'game' => $item->game,
                        'date' => $item->updated_at,
                    ];
                });

            return collect($reviews)
                ->merge($images)
                ->merge($wishlisted)
                ->sortByDesc('date')
                ->take(5)
                ->values();
        });

        return view('livewire.utils.preview-social-feed', compact('activities'));
    }
}