<?php

namespace App\Services;

use App\Models\User;

class ExperienceService
{
    // Valores de experiencia otorgados por cada acción
    const XP_PER_LIKE_RECEIVED = 10;
    const XP_PER_IMAGE = 30;
    const XP_PER_REVIEW = 50;

    /**
     * Define los rangos visuales para el camino de un usuario estándar.
     */
    public static function getLibraryRanks(): array
    {
        return [
            ['name' => 'Espectador', 'xp_required' => 0, 'color' => 'text-gray-500 dark:text-gray-400'],
            ['name' => 'Explorador', 'xp_required' => 1000, 'color' => 'text-emerald-600 dark:text-emerald-400'],
            ['name' => 'Coleccionista', 'xp_required' => 3500, 'color' => 'text-blue-600 dark:text-blue-400'],
            ['name' => 'Completista', 'xp_required' => 7000, 'color' => 'text-purple-600 dark:text-purple-400'],
            ['name' => 'Veterano', 'xp_required' => 10000, 'color' => 'text-yellow-600 dark:text-yellow-500'],
        ];
    }

    /**
     * Determina el rango actual del usuario evaluando primero su rol en base de datos.
     */
    public static function getCurrentRank(User $user): array
    {
        // Prioridad para roles otorgados manualmente o por ascenso
        if ($user->role === 'admin') {
            return ['name' => 'Administrador', 'xp_required' => 0, 'color' => 'text-red-600 dark:text-red-500'];
        }

        if ($user->role === 'journalist') {
            return ['name' => 'Periodista', 'xp_required' => 0, 'color' => 'text-indigo-600 dark:text-indigo-400'];
        }

        if ($user->role === 'veteran') {
            return ['name' => 'Veterano', 'xp_required' => 10000, 'color' => 'text-yellow-600 dark:text-yellow-500'];
        }

        // Progresión por XP para el rol 'standard'
        $ranks = self::getLibraryRanks();
        $currentRank = $ranks[0];

        foreach ($ranks as $rank) {
            if ($user->xp >= $rank['xp_required']) {
                $currentRank = $rank;
            } else {
                break;
            }
        }

        return $currentRank;
    }

    /**
     * Encuentra el siguiente escalón en la progresión.
     */
    public static function getNextRank(User $user): ?array
    {
        if (in_array($user->role, ['admin', 'journalist', 'veteran'])) {
            return null;
        }

        $ranks = self::getLibraryRanks();

        foreach ($ranks as $rank) {
            if ($user->xp < $rank['xp_required']) {
                return $rank;
            }
        }

        return null;
    }

    /**
     * Suma XP al usuario y gestiona el cambio de rol a Veterano.
     */
    public static function addXp(User $user, int $amount): bool
    {
        if (in_array($user->role, ['admin', 'journalist'])) {
            return false;
        }

        $user->increment('xp', $amount);
        $user->refresh();

        // Umbral de ascenso oficial en base de datos
        if ($user->role === 'standard' && $user->xp >= 10000) {
            $user->update(['role' => 'veteran']);
            return true;
        }

        return false;
    }
}