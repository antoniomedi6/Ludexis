<?php

namespace App\Livewire\Vistas\WithLogin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyLibrary extends Component
{
    // Valores por defecto
    public string $filterBy = '';
    public string $orderBy = 'updated_at';

    public function render()
    {
        $query = Auth::user()->games()
            ->withPivot('status', 'rating', 'hours_finish', 'hours_completed', 'updated_at')
            ->select('games.id', 'games.title', 'games.slug', 'games.cover_url');

        if ($this->filterBy !== '') {
            $query->wherePivot('status', $this->filterBy);
        }

        switch ($this->orderBy) {
            case 'rating':
                $query->orderByPivot('rating', 'desc');
                break;
            case 'time':
                $query->orderByPivot('hours_finish', 'desc');
                break;
            case 'updated_at':
            default:
                $query->orderByPivot('updated_at', 'desc');
                break;
        }

        $userGames = $query->get();

        return view('livewire.vistas.with-login.my-library', compact('userGames'));
    }
}