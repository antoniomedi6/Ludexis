<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public Model $model;

    public bool $isLiked = false;
    public int $likesCount = 0;
    public bool $isOwner = false;

    public function mount(Model $model)
    {
        $this->model = $model;

        $authUser = Auth::user();
        if ($authUser) {
            $this->isLiked = $this->model->isLikedBy($authUser);
        }

        // El componente solo se usa en modelos con user_id (reseñas/capturas)
        $this->isOwner = isset($this->model->user_id) && ($this->model->user_id === Auth::id());

        $this->likesCount = $this->model->likes_count;
    }

    public function render()
    {
        return view('livewire.utils.like-button');
    }

    public function toggleLike(): void
    {

        // Evita que el autor pueda darse like a sí mismo
        if ($this->isOwner) {
            $this->dispatch('notify', message: 'No puedes darte like a tu propio contenido.', type: 'error');
            return;
        }

        $user = Auth::user();
        $this->authorize('interact-with-model', $this->model);

        $this->model->toggleLike($user);

        $this->isLiked = !$this->isLiked;
        $this->likesCount = $this->model->likes()->count();

        $this->dispatch('like-toggled', modelId: $this->model->id, likesCount: $this->likesCount);
    }
}
