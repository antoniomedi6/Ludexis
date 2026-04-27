<?php

namespace App\Livewire\Utils;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfileFollowBlock extends Component
{
    public int $userId;

    public bool $showModal = false;

    public string $modalDefaultTab = 'followers';

    public function mount(int $userId): void
    {
        $this->userId = $userId;
    }

    #[On('evtUserProfileRefresh')]
    public function render(): View
    {
        $profile = $this->profile();

        $followersCount = (int) $profile->approved_followers_count;
        $followingsCount = (int) $profile->approved_followings_count;

        $followersList = collect();
        $followingsList = collect();

        if ($this->showModal) {
            $followersList = $profile
                ->approvedFollowers()
                ->orderByDesc('followables.created_at')
                ->get();

            $followingsList = $profile
                ->approvedFollowings()
                ->with([
                    'followable' => function ($q) {
                        $q->select('id', 'name', 'profile_photo_path');
                    }
                ])
                ->orderByDesc('created_at')
                ->get()
                ->pluck('followable')
                ->filter();
        }

        return view('livewire.utils.profile-follow-block', compact(
            'followersCount',
            'followingsCount',
            'followersList',
            'followingsList',
        ));
    }

    private function profile(): User
    {
        return User::query()
            ->whereKey($this->userId)
            ->withCount(['approvedFollowers', 'approvedFollowings'])
            ->firstOrFail();
    }

    public function openFollowList(string $tab): void
    {
        if (! in_array($tab, ['followers', 'followings'], true)) {
            $tab = 'followers';
        }

        $this->modalDefaultTab = $tab;
        $this->showModal = true;
    }

}
