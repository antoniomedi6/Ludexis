<?php

namespace App\Traits;

use App\Models\Report;
use App\Models\User;

/**
 * Trait reutilizable para implementar Reportes.
 * Permite que cualquier modelo (Usuarios, Imágenes, Reseñas, etc.) pueda ser
 * denunciado compartiendo la misma tabla en la base de datos.
 */
trait Reportable
{
    // RELACIÓN POLIMÓRFICA
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    // VERIFICACIÓN DE ESTADO
    public function isReportedBy(?User $user = null): bool
    {
        $user = $user ?: auth()->user();

        if (!$user) {
            return false;
        }

        return $this->reports()->where('user_id', $user->id)->exists();
    }

    // CREACIÓN
    public function report(string $reason, ?User $user = null): void
    {
        $user = $user ?: auth()->user();

        if (!$user) {
            return;
        }

        if ($this->isReportedBy($user)) {
            return;
        }

        $this->reports()->create([
            'user_id' => $user->id,
            'reason' => $reason,
            'status' => 'Pending',
        ]);
    }

    // CONTEO
    public function getReportsCountAttribute(): int
    {
        return $this->reports()->count();
    }
}
