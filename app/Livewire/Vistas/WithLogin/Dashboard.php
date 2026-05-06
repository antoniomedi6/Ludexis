<?php

namespace App\Livewire\Vistas\WithLogin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $userGames = Auth::user()->games()->with('genres')->get();

        $genreStats = [];
        $genreCounts = [];
        $totalGenreTags = 0;

        if ($userGames->isNotEmpty()) {
            foreach ($userGames as $game) {
                foreach ($game->genres as $genre) {
                    $genreCounts[$genre->name] = ($genreCounts[$genre->name] ?? 0) + 1;
                    $totalGenreTags++;
                }
            }

            arsort($genreCounts);
            $topGenres = array_slice($genreCounts, 0, 4, true);

            $colors = ['bg-cyan-500', 'bg-purple-500', 'bg-teal-500', 'bg-yellow-500'];
            $i = 0;

            foreach ($topGenres as $name => $count) {
                $genreStats[] = [
                    'name' => $name,
                    'percentage' => $totalGenreTags > 0 ? round(($count / $totalGenreTags) * 100) : 0,
                    'color' => $colors[$i % count($colors)]
                ];
                $i++;
            }
        }

        $completedGamesCount = $userGames->where('pivot.status', 'completed')->count();

        $totalHours = $userGames->sum(
            fn ($game) => (int) ($game->pivot->hours_finish ?? 0) + (int) ($game->pivot->hours_completed ?? 0)
        );

        return view('livewire.vistas.with-login.dashboard', compact(
            'userGames',
            'genreStats',
            'completedGamesCount',
            'totalHours',
        ));
    }
}
