<?php

namespace App\Services;

use App\Models\User;

/**
 * Servicio encargado de gestionar el sistema de niveles y experiencia de la plataforma.
 * Define la tabla de progresión de rangos, evalúa el estado actual de un usuario
 * teniendo en cuenta sus roles fijos, y gestiona el incremento de XP junto con
 * los ascensos automáticos en la base de datos (ej. paso a Veterano).
 */
class ExperienceService
{
    // CONFIGURACIÓN DE XP
    const XP_PER_LIKE_RECEIVED = 10;
    const XP_PER_IMAGE = 30;
    const XP_PER_REVIEW = 50;

    // DEFINICIÓN DE RANGOS
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

    // EVALUACIÓN DE RANGO ACTUAL
    public static function getCurrentRank(User $user): array
    {
        // 1. Roles con prioridad
        if ($user->role === 'admin') {
            return ['name' => 'Administrador', 'xp_required' => 0, 'color' => 'text-red-600 dark:text-red-500'];
        }

        if ($user->role === 'journalist') {
            return ['name' => 'Periodista', 'xp_required' => 0, 'color' => 'text-indigo-600 dark:text-indigo-400'];
        }

        if ($user->role === 'veteran') {
            return ['name' => 'Veterano', 'xp_required' => 10000, 'color' => 'text-yellow-600 dark:text-yellow-500'];
        }

        // 2. Progresión por XP
        $ranks = self::getLibraryRanks();
        $currentRank = $ranks[0];

        $xp = (int) ($user->xp ?? 0);

        foreach ($ranks as $rank) {
            if ($xp >= $rank['xp_required']) {
                $currentRank = $rank;
            } else {
                break;
            }
        }

        return $currentRank;
    }

    // CÁLCULO DE SIGUIENTE RANGO
    public static function getNextRank(User $user): ?array
    {
        if (in_array($user->role, ['admin', 'journalist', 'veteran'])) {
            return null;
        }

        $ranks = self::getLibraryRanks();
        $xp = (int) ($user->xp ?? 0);

        foreach ($ranks as $rank) {
            if ($xp < $rank['xp_required']) {
                return $rank;
            }
        }

        return null;
    }

    // SUMA DE XP Y CONTROL DE ASCENSO
    public static function addXp(User $user, int $amount): bool
    {
        if (in_array($user->role, ['admin', 'journalist'])) {
            return false;
        }

        if ($amount === 0) {
            return false;
        }

        $currentXp = (int) ($user->xp ?? 0);
        $newXp = $currentXp + $amount;

        if ($newXp < 0) {
            $newXp = 0;
        }

        if ($newXp === $currentXp) {
            return false;
        }

        $user->update(['xp' => $newXp]);
        $user->refresh();

        if ($user->role === 'standard' && $user->xp >= 10000) {
            $user->update(['role' => 'veteran']);
            return true;
        }

        return false;
    }
}