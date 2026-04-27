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
        /* README: $follower->hasRequestedToFollow($followable) — solicitud pendiente enviada por el visitante. */
        $hasRequestedToFollow = (bool) ($authUser ? $authUser->hasRequestedToFollow($target) : false);

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
        $this->dispatch('evtNotificationsRefresh');
    }

    /* Deja de seguir y dispara el refresco de la vista. */
    public function unfollow(): void
    {
        Auth::user()->unfollow($this->followable());

        $this->dispatch('evtFollowButtonRefresh')->self();
        $this->dispatch('evtUserProfileRefresh');
        $this->dispatch('evtNotificationsRefresh');
    }

    /* Alterna seguir / dejar de seguir; si hay solicitud pendiente (README: hasRequestedToFollow), unfollow cancela la solicitud. */
    public function toggleFollow(): void
    {
        $followable = $this->followable();
        $auth = Auth::user();

        if ($auth->hasRequestedToFollow($followable)) {
            $auth->unfollow($followable);
        } else {
            $auth->toggleFollow($followable);
        }

        $this->dispatch('evtFollowButtonRefresh')->self();
        $this->dispatch('evtUserProfileRefresh');
        $this->dispatch('evtNotificationsRefresh');
    }
}
