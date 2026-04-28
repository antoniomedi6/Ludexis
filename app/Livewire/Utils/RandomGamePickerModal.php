<?php

namespace App\Livewire\Utils;

use App\Models\CustomList;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RandomGamePickerModal extends Component
{
    public bool $showModal = false;
    public $selectedSource = 'general';
    public $selectedListId = null;
    public $minRating = 70;
    public $randomGame = null;

    public function render()
    {
        $userLists = CustomList::where('user_id', Auth::id())
            ->withCount('games')
            ->orderBy('name')
            ->get();

        return view('livewire.utils.random-game-picker-modal', compact('userLists'));
    }

    // Busca un juego aleatorio según el origen y el ranking mínimo.
    public function pickGame()
    {
        $query = Game::query();

        if ($this->selectedSource === 'library') {
            $query = Auth::check()
                ? Auth::user()->games()
                : $this->emptyQuery();
        }

        if ($this->selectedSource === 'list') {
            $query = $this->listQuery();
        }

        $this->randomGame = $query
            ->where('games.rating', '>=', $this->minRating)
            ->select('games.id', 'games.title', 'games.slug', 'games.cover_url', 'games.rating', 'games.avg_time')
            ->inRandomOrder()
            ->first();

        if (!$this->randomGame) {
            $this->dispatch('notify', message: 'No hay juegos disponibles con esos filtros.', type: 'info');
        }
    }

    // Limpia la selección al cambiar de origen.
    public function updatedSelectedSource()
    {
        $this->selectedListId = null;
        $this->randomGame = null;
    }

    // Reinicia el resultado si cambia la lista elegida.
    public function updatedSelectedListId()
    {
        $this->randomGame = null;
    }

    // Reinicia el resultado si cambia el ranking mínimo.
    public function updatedMinRating()
    {
        $this->randomGame = null;
    }

    // Devuelve la query de juegos de la lista seleccionada.
    private function listQuery()
    {
        if (!Auth::check() || !$this->selectedListId) {
            return $this->emptyQuery();
        }

        $list = CustomList::where('user_id', Auth::id())->find($this->selectedListId);

        if (!$list) {
            return $this->emptyQuery();
        }

        return $list->games();
    }

    // Query vacía para evitar resultados fuera de contexto.
    private function emptyQuery()
    {
        return Game::query()->whereRaw('1 = 0');
    }
}
