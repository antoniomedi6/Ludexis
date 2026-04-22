<?php

namespace App\Livewire\Vistas\WithLogin\Admin;

use App\Models\GameUser;
use App\Models\Image;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Reports extends Component
{
    public string $statusFilter = 'Pending';
    public string $typeFilter = 'all';

    public function render()
    {
        $q = Report::query()
            ->with([
                'user',
                'reportable' => function ($morphTo) {
                    $morphTo->morphWith([
                        User::class => [],
                        Image::class => ['user', 'game'],
                        GameUser::class => ['user', 'game'],
                    ]);
                },
            ])
            ->where('status', $this->statusFilter);

        if ($this->typeFilter !== 'all') {
            $typeMap = [
                'User' => User::class,
                'Image' => Image::class,
                'GameUser' => GameUser::class,
            ];
            $q->where('reportable_type', $typeMap[$this->typeFilter]);
        }

        $reports = $q->latest()->get();

        $pendingCount = Report::where('status', 'Pending')->count();
        $resolvedCount = Report::where('status', 'Resolved')->count();

        $userReports = Report::where('status', 'Pending')->where('reportable_type', User::class)->count();
        $imageReports = Report::where('status', 'Pending')->where('reportable_type', Image::class)->count();
        $reviewReports = Report::where('status', 'Pending')->where('reportable_type', GameUser::class)->count();

        return view('livewire.vistas.with-login.admin.reports', compact(
            'reports',
            'pendingCount',
            'resolvedCount',
            'userReports',
            'imageReports',
            'reviewReports',
        ));
    }

    // Cambia el filtro de estado
    public function setStatus(string $status): void
    {
        $this->statusFilter = in_array($status, ['Pending', 'Resolved']) ? $status : 'Pending';
    }

    // Cambia el filtro por tipo de reporte
    public function setType(string $type): void
    {
        $this->typeFilter = in_array($type, ['all', 'User', 'Image', 'GameUser']) ? $type : 'all';
    }

    // Banea al usuario reportado y resuelve el reporte
    public function banUser(int $reportId): void
    {
        $report = Report::findOrFail($reportId);

        if ($report->reportable_type !== User::class) {
            return;
        }

        $target = $report->reportable;

        if (!$target || $target->id === Auth::id()) {
            return;
        }

        $target->banned_at = now();
        $target->save();

        $this->resolve($report, 'Usuario baneado correctamente.');
    }

    // Desbanea al usuario reportado
    public function unbanUser(int $reportId): void
    {
        $report = Report::findOrFail($reportId);

        if ($report->reportable_type !== User::class) {
            return;
        }

        $target = $report->reportable;

        if (!$target) {
            return;
        }

        $target->banned_at = null;
        $target->save();

        $this->dispatch('notify', message: 'Usuario desbaneado correctamente.', type: 'success');
    }

    // Elimina la imagen reportada y resuelve el reporte
    public function deleteImage(int $reportId): void
    {
        $report = Report::findOrFail($reportId);

        if ($report->reportable_type !== Image::class) {
            return;
        }

        $image = $report->reportable;

        if (!$image) {
            $this->resolve($report);
            return;
        }

        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        $this->resolve($report, 'Imagen eliminada correctamente.');
    }

    // Elimina el texto de la reseña y resuelve el reporte
    public function deleteReview(int $reportId): void
    {
        $report = Report::findOrFail($reportId);

        if ($report->reportable_type !== GameUser::class) {
            return;
        }

        $gameUser = $report->reportable;

        if (!$gameUser) {
            $this->resolve($report);
            return;
        }

        $gameUser->review = null;
        $gameUser->save();

        $this->resolve($report, 'Reseña eliminada correctamente.');
    }

    // Resuelve el reporte sin aplicar otra acción
    public function markResolved(int $reportId): void
    {
        $report = Report::findOrFail($reportId);
        if ($report->status !== 'Pending') {
            return;
        }
        $this->resolve($report);
    }

    // Reabre un reporte resuelto para devolverlo al estado Pendiente
    public function reopen(int $reportId): void
    {
        $report = Report::findOrFail($reportId);
        if ($report->status !== 'Resolved') {
            return;
        }
        $report->update(['status' => 'Pending']);
        $this->dispatch('notify', message: 'Reporte reabierto correctamente.', type: 'success');
    }

    // Marca el reporte como Resuelto y notifica el resultado
    private function resolve(Report $report, string $message = 'Reporte resuelto.'): void
    {
        $report->update(['status' => 'Resolved']);
        $this->dispatch('notify', message: $message, type: 'success');
    }
}
