<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\User;

trait Likeable
{
    // Relación polimórfica hacia la tabla likes
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // Comprueba si un usuario ha dado like a este modelo
    public function isLikedBy(?User $user = null): bool
    {
        $user = $user ?: auth()->user();

        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // Alterna el like (si lo tiene lo quita, si no lo tiene lo pone) 
    public function toggleLike(?User $user = null): void
    {
        $user = $user ?: auth()->user();

        if (!$user) {
            return;
        }

        if ($this->isLikedBy($user)) {
            $this->likes()->where('user_id', $user->id)->delete();
        } else {
            $this->likes()->create(['user_id' => $user->id]);
        }
    }

    // {{-- Obtiene el conteo total de likes --}}
    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }
}