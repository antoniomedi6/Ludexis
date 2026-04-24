<?php

namespace App\Livewire\Vistas;

use App\Models\GameUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowUserProfile extends Component
{
    public User $user;
    public bool $canViewPrivateData = false;
    public string $selectedRole = 'standard';
    public string $reportReason = '';

    public function mount(int $userId)
    {
        $this->user = User::findOrFail($userId);

        $this->canViewPrivateData = !$this->user->is_private
            || (Auth::check() && (Auth::id() === $this->user->id || Auth::user()->role === 'admin'));

        if ($this->canViewPrivateData) {
            $this->user->load([
                'games',
                'customLists' => function ($q) {
                    $q->withCount('games');
                }
            ]);
        }

        $this->selectedRole = (string) ($this->user->role ?? 'standard');
    }

    public function updateRole(): void
    {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);

        $this->validate([
            'selectedRole' => ['required', 'in:standard,journalist,veteran,admin'],
        ]);

        if (Auth::id() === $this->user->id) {
            return;
        }

        $this->user->role = $this->selectedRole;
        $this->user->save();

        $this->dispatch('role-updated');
    }

    public function submitReport(): void
    {
        abort_unless(Auth::check(), 403);

        $this->validate([
            'reportReason' => ['required', 'string', 'max:255'],
        ]);

        if (Auth::id() === $this->user->id) {
            return;
        }

        $this->user->report($this->reportReason);

        $this->reportReason = '';
        $this->dispatch('report-sent');
    }

    public function render()
    {
        $canViewPrivateData = $this->canViewPrivateData;

        $games = $this->canViewPrivateData ? $this->user->games : collect();
        $customLists = $this->canViewPrivateData ? $this->user->customLists : collect();

        $totalHours = $games->sum(fn($game) => ($game->pivot->hours_finish ?? 0) + ($game->pivot->hours_completed ?? 0));

        $averageRating = $games->avg('pivot.rating') ?? 0;

        $statusCounts = $games->countBy('pivot.status');

        $completedCount = $statusCounts['completed'] ?? 0;
        $playingCount = $statusCounts['playing'] ?? 0;
        $pendingCount = $statusCounts['pending'] ?? 0;
        $abandonedCount = $statusCounts['abandoned'] ?? 0;

        $topGames = $games->sortByDesc('pivot.rating')->take(3);
        $recentActivity = $games->sortByDesc('pivot.updated_at')->take(10);
        $reviews = collect();

        if ($this->canViewPrivateData) {
            $reviews = GameUser::with(['game:id,title,cover_url,slug'])
                ->where('user_id', $this->user->id)
                ->whereNotNull('review')
                ->latest('updated_at')
                ->get();
        }

        return view('livewire.vistas.show-user-profile', compact(
            'games',
            'customLists',
            'totalHours',
            'averageRating',
            'completedCount',
            'playingCount',
            'pendingCount',
            'abandonedCount',
            'topGames',
            'recentActivity',
            'reviews',
            'canViewPrivateData',
        ));
    }
}
