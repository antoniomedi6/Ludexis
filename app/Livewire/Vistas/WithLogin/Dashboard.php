<?php

namespace App\Livewire\Vistas\WithLogin;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $userGames = Auth::user()->games()->get();
        return view('livewire.vistas.with-login.dashboard', compact('userGames'));
    }
}