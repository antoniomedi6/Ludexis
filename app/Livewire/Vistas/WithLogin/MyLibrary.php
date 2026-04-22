<?php

namespace App\Livewire\Vistas\WithLogin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyLibrary extends Component
{
    public string $filterBy = '';
    public string $orderBy = 'updated_at';
    public int $limit = 22;

    public string $search = '';

    public function render()
    {
        $q = Auth::user()->games()
            ->withPivot('status', 'rating', 'hours_finish', 'hours_completed', 'updated_at')
            ->select('games.id', 'games.title', 'games.slug', 'games.cover_url');

        if ($this->search !== '') {
            $q->where('games.title', 'like', '%' . $this->search . '%');
        }

        if ($this->filterBy !== '') {
            $q->wherePivot('status', $this->filterBy);
        }

        switch ($this->orderBy) {
            case 'rating':
                $q->orderByPivot('rating', 'desc');
                break;
            case 'time':
                $q->orderByPivot('hours_finish', 'desc');
                break;
            case 'updated_at':
            default:
                $q->orderByPivot('updated_at', 'desc');
                break;
        }

        $userGames = $q->limit($this->limit)->get();

        return view('livewire.vistas.with-login.my-library', compact('userGames'));
    }

    public function updatedSearch()
    {
        $this->limit = 22;
    }

    public function loadMore()
    {
        $this->limit += 22;
    }
}