<?php

namespace App\Livewire\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowButton extends Component
{
    public int $userId;

    /* Recibe el perfil a seguir y guarda su id. */
    public function mount(User $user): void
    {
        $this->userId = (int) $user->getKey();
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
    }

    /* Deja de seguir y dispara el refresco de la vista. */
    public function unfollow(): void
    {

        Auth::user()->unfollow($this->followable());

        $this->dispatch('evtFollowButtonRefresh')->self();
    }

    /* Alterna seguir, dejar de seguir y dispara el refresco. */
    public function toggleFollow(): void
    {
        Auth::user()->toggleFollow($this->followable());

        $this->dispatch('evtFollowButtonRefresh')->self();
    }

    #[On('evtFollowButtonRefresh')]
    public function render()
    {
        $target = $this->followable();

        $isFollowing = false;
        $hasRequestedToFollow = false;

        $isFollowing = (bool) Auth::user()->isFollowing($target);
        $hasRequestedToFollow = (bool) $target->hasRequestedToFollow(Auth::user());

        return view('livewire.utils.follow-button', compact(
            'isFollowing',
            'hasRequestedToFollow',
        ));
    }
}
