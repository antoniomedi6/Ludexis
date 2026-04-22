<?php

namespace App\Livewire\Vistas\WithLogin;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserTimeline extends Component
{
    public string $filterOption = 'current_year';

    public function setFilter(string $option): void
    {
        $this->filterOption = in_array($option, ['current_year', 'current_month'])
            ? $option
            : 'current_year';
    }

    public function render()
    {
        $dateLimit = $this->getDateLimit();

        $activities = Activity::with('game')
            ->whereHas('game')
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $dateLimit)
            ->orderBy('created_at', 'desc')
            ->get();

        $monthsSummary = $activities->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m');
        })->map(function ($monthActivities, $monthKey) {
            $date = Carbon::parse($monthKey);

            return [
                'month_name' => $date->translatedFormat('F'),
                'year' => $date->format('Y'),
                'activities' => $monthActivities,
                'total_hours' => $monthActivities->sum('hours_played'),
                'unique_games_count' => $monthActivities->pluck('game_id')->unique()->count(),
                'covers' => $monthActivities->map(fn($a) => $a->game->cover_url ?? null)
                    ->filter()
                    ->unique()
                    ->take(5),
                'top_game' => $monthActivities->groupBy('game_id')
                    ->map(fn($group) => [
                        'game' => $group->first()->game,
                        'hours' => $group->sum('hours_played')
                    ])
                    ->sortByDesc('hours')
                    ->first()['game'] ?? null,
            ];
        });

        return view('livewire.vistas.with-login.user-timeline', compact('monthsSummary'));
    }

    private function getDateLimit(): Carbon
    {
        return match ($this->filterOption) {
            'current_month' => Carbon::now()->startOfMonth(),
            'current_year' => Carbon::now()->startOfYear(),
            default => Carbon::now()->startOfYear(),
        };
    }
}