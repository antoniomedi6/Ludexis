<?php

namespace App\Livewire\Vistas;

use App\Models\GameUser;
use App\Models\User;
use Livewire\Component;

class ShowUserProfile extends Component
{
    public User $user;

    public function mount(int $userId)
    {
        $this->user = User::findOrFail($userId);
    }

    public function render()
    {
        $games = GameUser::where('user_id', $this->user->id)->get();

        $totalHours = $games->sum('hours_finish');
        $averageRating = $games->avg('rating') ?? 0;
        $statusCounts = $games->countBy('status');

        $completedCount = $statusCounts['completed'] ?? 0;
        $playingCount = $statusCounts['playing'] ?? 0;
        $pendingCount = $statusCounts['pending'] ?? 0;
        $abandonedCount = $statusCounts['abandoned'] ?? 0;

        return view('livewire.vistas.show-user-profile', compact(
            'totalHours',
            'averageRating',
            'completedCount',
            'playingCount',
            'pendingCount',
            'abandonedCount',
            'games'
        ));
    }
}