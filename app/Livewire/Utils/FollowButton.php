<?php

namespace App\Livewire\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowButton extends Component
{
    public int $userId;

    public bool $compact = false;

    /* Recibe el perfil a seguir y guarda su id. */
    public function mount(User $user, bool $compact = false): void
    {
        $this->userId = (int) $user->getKey();
        $this->compact = $compact;
    }

    #[On('evtFollowButtonRefresh')]
    public function render(): View
    {
        $target = $this->followable();

        $isFollowing = false;
        $hasRequestedToFollow = false;

        $authUser = Auth::user();

        $isFollowing = (bool) ($authUser?->isFollowing($target));
        $hasRequestedToFollow = (bool) ($authUser ? $target->hasRequestedToFollow($authUser) : false);

        return view('livewire.utils.follow-button', compact(
            'isFollowing',
            'hasRequestedToFollow',
        ));
    }

    /* Devuelve el usuario cuyo perfil se mostrará (el seguido), no el visitante. */
    private function followable(): User
    {
        return User::query()->findOrFail($this->userId);
    }

    /* Sigue al usuario del perfil y dispara el render de la vista. */
    public function follow(): void
    {
        Auth::user()->follow($this->followable());

        $this->dispatch('evtFollowButtonRefresh')->self();
        $this->dispatch('evtUserProfileRefresh');
    }

    /* Deja de seguir y dispara el refresco de la vista. */
    public function unfollow(): void
    {
        Auth::user()->unfollow($this->followable());

        $this->dispatch('evtFollowButtonRefresh')->self();
        $this->dispatch('evtUserProfileRefresh');
    }

    /* Alterna seguir, dejar de seguir y dispara el refresco. */
    public function toggleFollow(): void
    {
        Auth::user()->toggleFollow($this->followable());

        $this->dispatch('evtFollowButtonRefresh')->self();
        $this->dispatch('evtUserProfileRefresh');
    }
}
