<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\User;
use App\Services\ExperienceService;

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

        $owner = null;
        if (method_exists($this, 'user')) {
            $owner = $this->user;
        } elseif (property_exists($this, 'user_id') || isset($this->user_id)) {
            $owner = User::query()->find($this->user_id);
        }

        if ($this->isLikedBy($user)) {
            $this->likes()->where('user_id', $user->id)->delete();
            if ($owner && $owner->id !== $user->id) {
                ExperienceService::addXp($owner, -ExperienceService::XP_PER_LIKE_RECEIVED);
            }
        } else {
            $this->likes()->create(['user_id' => $user->id]);
            if ($owner && $owner->id !== $user->id) {
                ExperienceService::addXp($owner, ExperienceService::XP_PER_LIKE_RECEIVED);
            }
        }
    }

    // CONTEO
    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }
}