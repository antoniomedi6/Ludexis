<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewPrivateData(?User $user, User $model): bool
    {
        // Si el perfil no es privado, cualquiera puede ver.
        if (!$model->is_private) {
            return true;
        }

        if (!$user) {
            return false;
        }

        // Perfil privado: propio usuario, admin o seguidor aceptado.
        if ($user->id === $model->id || $user->role === 'admin') {
            return true;
        }

        return $user->isFollowing($model);
    }

    public function updateRole(User $user, User $model): bool
    {
        // Solo admin y no puede cambiarse el rol a sí mismo.
        if ($user->role !== 'admin') {
            return false;
        }

        return $user->id !== $model->id;
    }

    public function manageScreenshots(User $user, User $model): bool
    {
        // Permite ver/gestionar capturas privadas (spoilers) del usuario.
        return ($user->id === $model->id) || ($user->role === 'admin');
    }
}
