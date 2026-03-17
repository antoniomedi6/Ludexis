<?php

namespace App\Livewire\Vistas\WithLogin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyLibrary extends Component
{
    public function render()
    {
        $userGames = Auth::user()->games()
            ->withPivot('status', 'rating', 'hours_finish', 'hours_completed', 'updated_at')
            ->select('games.id', 'games.title', 'games.slug', 'games.cover_url')
            ->orderByPivot('updated_at', 'desc')
            ->get();

        return view('livewire.vistas.with-login.my-library', compact('userGames'));
    }
}