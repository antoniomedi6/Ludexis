<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\User;

/**
 * Trait reutilizable para implementar relaciones polimórficas de "Me gusta" (Likes).
 * Permite que cualquier modelo (Imágenes, Reseñas, etc.) pueda recibir interacciones
 * compartiendo la misma tabla en la base de datos y la misma lógica de negocio.
 */
trait Likeable
{
    // RELACIÓN POLIMÓRFICA
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // VERIFICACIÓN DE ESTADO
    public function isLikedBy(?User $user = null): bool
    {
        $user = $user ?: auth()->user();

        if (!$user) {
            return false;
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // ALTERNANCIA (TOGGLE)
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

    // CONTEO
    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }
}