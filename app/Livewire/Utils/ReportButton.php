<?php

namespace App\Livewire\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportButton extends Component
{
    public Model $model;

    public bool $isReported = false;
    public bool $openModal = false;
    public string $reportReason = '';
    public bool $isOwner = false;

    public function mount(Model $model)
    {
        $this->model = $model;

        if (Auth::check()) {
            $this->isReported = $this->model->isReportedBy(Auth::user());
        }

        // El componente se usa en modelos con user_id (reseñas/capturas)
        $this->isOwner = isset($this->model->user_id) && ($this->model->user_id === Auth::id());
    }

    public function openReport(): void
    {
        if (!Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        $this->reportReason = '';
        $this->resetErrorBag();
        $this->openModal = true;
    }

    public function closeReport(): void
    {
        $this->openModal = false;
        $this->reportReason = '';
        $this->resetErrorBag();
    }

    public function submitReport(): void
    {

        if ($this->isOwner) {
            return;
        }

        $this->authorize('interact-with-model', $this->model);

        $this->validate([
            'reportReason' => ['required', 'string', 'max:255'],
        ]);

        $this->model->report($this->reportReason);

        $this->isReported = true;
        $this->openModal = false;
        $this->reportReason = '';

        $this->dispatch('report-sent');
    }

    public function render()
    {
        return view('livewire.utils.report-button');
    }
}
