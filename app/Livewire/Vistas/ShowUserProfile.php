<?php

namespace App\Livewire\Vistas;

use App\Models\GameUser;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowUserProfile extends Component
{
    public User $user;

    public string $selectedRole = 'standard';

    public string $reportReason = '';

    public function mount(int $userId)
    {
        $this->user = User::findOrFail($userId);

        $this->selectedRole = (string) ($this->user->role ?? 'standard');
    }

    #[On('evtUserProfileRefresh')]
    public function render()
    {
        $canViewPrivateData = Gate::allows('viewPrivateData', $this->user);

        if ($canViewPrivateData) {
            $this->user->loadMissing([
                'games',
                'customLists' => function ($q) {
                    $q->withCount('games');
                },
            ]);
        }
        // Esto no es solo para mostrar/ocultar botones en la vista. También controla qué capturas se consultan
        // y evita duplicar lógica en la vista.
        $canManageScreenshots = Gate::allows('manageScreenshots', $this->user);

        $games = $canViewPrivateData ? $this->user->games : collect();
        $customLists = $canViewPrivateData ? $this->user->customLists : collect();

        $totalHours = $games->sum(fn ($game) => ($game->pivot->hours_finish ?? 0) + ($game->pivot->hours_completed ?? 0));

        $averageRating = $games->avg('pivot.rating') ?? 0;

        $statusCounts = $games->countBy('pivot.status');

        $completedCount = $statusCounts['completed'] ?? 0;
        $playingCount = $statusCounts['playing'] ?? 0;
        $pendingCount = $statusCounts['pending'] ?? 0;
        $abandonedCount = $statusCounts['abandoned'] ?? 0;

        $topGames = $games->sortByDesc('pivot.rating')->take(3);
        $recentActivity = collect();
        $reviews = collect();
        $screenshots = collect();

        if ($canViewPrivateData) {
            $reviewActivity = GameUser::with(['game:id,title,cover_url,slug'])
                ->withCount('likes')
                ->where('user_id', $this->user->id)
                ->whereNotNull('review')
                ->where('review', '!=', '')
                ->latest('updated_at')
                ->limit(10)
                ->get();

            $imageActivityQuery = Image::with(['game:id,title,slug,cover_url'])
                ->withCount('likes')
                ->where('user_id', $this->user->id)
                ->latest();

            if (! $canManageScreenshots) {
                $imageActivityQuery->where('is_spoiler', false);
            }

            $imageActivity = $imageActivityQuery
                ->limit(10)
                ->get();

            $recentActivity = $reviewActivity
                ->concat($imageActivity)
                ->each(function ($item) {
                    $item->setAttribute('activity_at', $item->updated_at ?? $item->created_at);
                })
                ->sortByDesc('activity_at')
                ->values()
                ->take(10);

            $reviews = GameUser::with(['game:id,title,cover_url,slug'])
                ->withCount('likes')
                ->where('user_id', $this->user->id)
                ->whereNotNull('review')
                ->latest('updated_at')
                ->get();

            $q = Image::with(['game:id,title,slug,cover_url', 'user:id,name,profile_photo_path'])
                ->where('user_id', $this->user->id)
                ->latest();

            if (! $canManageScreenshots) {
                $q->where('is_spoiler', false);
            }

            $screenshots = $q->get();
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
            'screenshots',
            'canViewPrivateData',
            'canManageScreenshots',
        ));
    }

    public function updateRole(): void
    {
        $this->authorize('updateRole', $this->user);

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
        abort_unless(Auth::id(), 403);

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
}
