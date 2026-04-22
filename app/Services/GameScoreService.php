<?php

namespace App\Services;

use App\Models\Game;
use App\Models\GameUser;
use App\Models\User;

class GameScoreService
{
    private const IGDB_WEIGHT = 3.0;

    private const ROLE_WEIGHTS = [
        'admin' => 3.0,
        'journalist' => 3.0,
        'veteran' => 1.5,
        'standard' => 1.0,
    ];

    // Obtiene el peso del usuario según su rol
    public function weightForUser(?User $user): float
    {
        $role = $user?->role;
        $weights = self::ROLE_WEIGHTS;

        $weight = $role && array_key_exists($role, $weights)
            ? $weights[$role]
            : ($weights['standard'] ?? 1);

        return (float) $weight;
    }

    // Recalcula la nota global combinando IGDB y ratings de usuarios ponderados por rol
    public function recalculate(Game $game): void
    {
        // igdb_rating guarda la nota base de IGDB para no perderla cuando rating pase a ser la nota ajustada
        $igdbRating = $game->igdb_rating ?? $game->rating ?? null;
        $igdbRating = $igdbRating === null ? null : (float) $igdbRating;

        $igdbWeight = self::IGDB_WEIGHT;

        // Solo contamos registros con rating del usuario
        $userRatings = GameUser::query()
            ->where('game_id', $game->id)
            ->whereNotNull('rating')
            ->with(['user:id,role'])
            ->get(['id', 'user_id', 'rating']);

        $weightedSum = 0.0;
        $weightSum = 0.0;

        // IGDB cuenta como un voto inicial con su propio peso (permite tener nota aunque no haya reviews)
        if ($igdbRating !== null && $igdbWeight > 0) {
            $weightedSum += $igdbRating * $igdbWeight;
            $weightSum += $igdbWeight;
        }

        foreach ($userRatings as $row) {
            $rating10 = (float) $row->rating;
            // Los usuarios puntúan 0–10, pero el juego muestra 0–100 como IGDB
            $rating100 = $rating10 * 10;

            $weight = $this->weightForUser($row->user);

            $weightedSum += $rating100 * $weight;
            $weightSum += $weight;
        }

        // Si no hay pesos, no hay promedio. Si hay, guardamos el promedio redondeado.
        $newRating = $weightSum > 0 ? round($weightedSum / $weightSum, 2) : null;

        $game->forceFill([
            'igdb_rating' => $igdbRating,
            'rating' => $newRating ?? $igdbRating,
        ])->save();
    }
}

