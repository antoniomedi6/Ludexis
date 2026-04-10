<?php

namespace App\Livewire\Utils;

use App\Models\CustomList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddGameToList extends Component
{
    public $showModal = false;
    public $gameId;

    public function mount($gameId)
    {
        $this->gameId = $gameId;
    }

    public function toggleGame($listId)
    {
        $list = CustomList::where('user_id', Auth::id())->findOrFail($listId);
        $list->games()->toggle($this->gameId);

        $this->dispatch('notify', message: 'Lista actualizada', type: 'success');
    }

    public function render()
    {
        $userLists = CustomList::where('user_id', Auth::id())
            ->withExists([
                'games as contains_game' => function ($query) {
                    $query->where('game_id', $this->gameId);
                }
            ])
            ->orderBy('name')
            ->get();

        return view('livewire.utils.add-game-to-list', compact('userLists'));
    }
}