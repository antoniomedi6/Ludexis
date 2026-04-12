<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class LikeButton extends Component
{
    // {{-- SYNOPSIS: Aceptamos cualquier modelo que use el trait Likeable (GameUser, Image, etc.) --}}
    public Model $model;

    public bool $isLiked = false;
    public int $likesCount = 0;

    public function mount(Model $model)
    {
        $this->model = $model;

        // Inicializamos el estado para no hacer consultas extra en la vista
        if (auth()->check()) {
            $this->isLiked = $this->model->isLikedBy(auth()->user());
        }
        $this->likesCount = $this->model->likesCount;
    }

    public function toggleLike()
    {
        // Alternamos el like en la base de datos
        $this->model->toggleLike(auth()->user());

        // Actualizamos el estado local (sin recargar de base de datos para que sea instantáneo)
        $this->isLiked = !$this->isLiked;
        $this->likesCount = $this->isLiked ? $this->likesCount + 1 : $this->likesCount - 1;
    }

    public function render()
    {
        return view('livewire.utils.like-button');
    }
}