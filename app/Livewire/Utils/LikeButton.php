<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Services\ExperienceService;

class LikeButton extends Component
{
    public Model $model;

    public bool $isLiked = false;
    public int $likesCount = 0;

    public function mount(Model $model)
    {
        $this->model = $model;

        if (Auth::check()) {
            $this->isLiked = $this->model->isLikedBy(Auth::user());
        }

        $this->likesCount = $this->model->likes_count;
    }

    public function toggleLike()
    {
        if (!Auth::check())
            return redirect()->route('login');

        $user = Auth::user();
        $this->authorize('interact-with-model', $this->model);

        $this->model->toggleLike($user);

        $this->isLiked = !$this->isLiked;
        $this->likesCount = $this->model->likes()->count();

        $this->dispatch('like-toggled', modelId: $this->model->id, likesCount: $this->likesCount);
    }

    public function render()
    {
        return view('livewire.utils.like-button');
    }
}