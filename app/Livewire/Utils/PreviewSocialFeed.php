<?php

namespace App\Livewire\Utils;

use App\Models\GameUser;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class PreviewSocialFeed extends Component
{
    public function render(): View
    {
        $auth = Auth::user();

        $hasFollowings = false;
        $followingUserIds = null;

        if ($auth instanceof User) {
            $followingUserIds = $auth
                ->approvedFollowings()
                ->where('followable_type', User::class)
                ->select('followable_id');

            $hasFollowings = $auth
                ->approvedFollowings()
                ->where('followable_type', User::class)
                ->exists();
        }

        $activities = collect();

        if ($auth instanceof User) {
            $reviewsQuery = GameUser::with(['user:id,name', 'game:id,title,cover_url,slug'])
                ->whereNotNull('rating')
                ->latest('updated_at');

            // Solo actividad de usuarios seguidos y la propia.
            $reviewsQuery->where(function ($q) use ($followingUserIds, $auth) {
                $q->whereIn('user_id', $followingUserIds)
                    ->orWhere('user_id', $auth->id);
            });

            $reviews = $reviewsQuery
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return (object) [
                        'type' => 'review',
                        'user' => $item->user,
                        'game' => $item->game,
                        'rating' => $item->rating,
                        'review' => $item->review,
                        'date' => $item->updated_at,
                    ];
                });

            $imagesQuery = Image::with(['user:id,name', 'game:id,title,cover_url,slug'])
                ->where('is_spoiler', false)
                ->latest();

            // Solo actividad de usuarios seguidos y la propia.
            $imagesQuery->where(function ($q) use ($followingUserIds, $auth) {
                $q->whereIn('user_id', $followingUserIds)
                    ->orWhere('user_id', $auth->id);
            });

            $images = $imagesQuery
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return (object) [
                        'id' => $item->id,
                        'type' => 'capture',
                        'user' => $item->user,
                        'game' => $item->game,
                        'image_path' => $item->image_path,
                        'date' => $item->created_at,
                    ];
                });

            $wishlistedQuery = GameUser::with(['user:id,name', 'game:id,title,slug'])
                ->where('status', 'pending')
                ->latest('updated_at');

            // Solo actividad de usuarios seguidos y la propia.
            $wishlistedQuery->where(function ($q) use ($followingUserIds, $auth) {
                $q->whereIn('user_id', $followingUserIds)
                    ->orWhere('user_id', $auth->id);
            });

            $wishlisted = $wishlistedQuery
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return (object) [
                        'type' => 'wishlist',
                        'user' => $item->user,
                        'game' => $item->game,
                        'date' => $item->updated_at,
                    ];
                });

            $activities = collect($reviews)
                ->merge($images)
                ->merge($wishlisted)
                ->sortByDesc('date')
                ->take(5)
                ->values();
        }

        return view('livewire.utils.preview-social-feed', compact('activities', 'hasFollowings'));
    }
}
