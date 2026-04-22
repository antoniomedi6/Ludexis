<?php

namespace App\Livewire\Utils;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportButton extends Component
{
    public Model $model;

    public bool $isReported = false;
    public bool $openModal = false;
    public string $reportReason = '';

    public function mount(Model $model)
    {
        $this->model = $model;

        if (Auth::check()) {
            $this->isReported = $this->model->isReportedBy(Auth::user());
        }
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
        abort_unless(Auth::check(), 403);

        $this->authorize('interact-with-model', $this->model);

        $this->validate([
            'reportReason' => ['required', 'string', 'max:255'],
        ]);

        $ownerId = $this->model instanceof User
            ? $this->model->id
            : ($this->model->user_id ?? null);

        if ($ownerId && $ownerId === Auth::id()) {
            return;
        }

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
