<?php

namespace App\Livewire\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationBell extends Component
{
    #[On('evtNotificationsRefresh')]
    public function render(): View
    {
        $followableUser = Auth::user();

        $pendingFollowers = collect();
        $recentFollowers = collect();
        $badgeCount = 0;

        if ($followableUser instanceof User) {
            $followablesTable = config('follow.followables_table', 'followables');

            $pendingFollowers = $followableUser->notApprovedFollowers()
                ->orderByDesc($followablesTable . '.created_at')
                ->get();

            $recentFollowers = $followableUser->approvedFollowers()
                ->orderByDesc($followablesTable . '.accepted_at')
                ->limit(15)
                ->get();

            $badgeCount = $pendingFollowers->count();
        }

        return view('livewire.utils.notification-bell', compact(
            'pendingFollowers',
            'recentFollowers',
            'badgeCount',
        ));
    }

    public function acceptFollowRequest(int $followerId): void
    {
        $followableUser = Auth::user();
        abort_unless($followableUser instanceof User, 403);

        $follower = User::query()->findOrFail($followerId);
        $followableUser->acceptFollowRequestFrom($follower);
    }

    public function rejectFollowRequest(int $followerId): void
    {
        $followableUser = Auth::user();
        abort_unless($followableUser instanceof User, 403);

        $follower = User::query()->findOrFail($followerId);
        $followableUser->rejectFollowRequestFrom($follower);
    }
}
