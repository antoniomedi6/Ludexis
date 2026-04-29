<?php

namespace App\Livewire\Vistas\WithLogin\Lists;

use App\Livewire\Forms\Lists\UpdateListForm;
use App\Models\CustomList;
use App\Models\GameUser;
use Livewire\Component;

class ShowUserList extends Component
{
    public $listId;
    public bool $showUpdateModal = false;
    public bool $confirmingListDeletion = false;
    public UpdateListForm $uform;

    // INICIALIZACION

    public function mount(CustomList $list)
    {
        $this->listId = $list->id;
    }

    public function render()
    {
        $list = CustomList::withCount('games')->with('games')->findOrFail($this->listId);

        $gameIds = $list->games->pluck('id');

        $userRegisters = GameUser::where('user_id', auth()->id())
            ->whereIn('game_id', $gameIds)
            ->get(['game_id', 'status', 'rating', 'hours_finish']);

        return view('livewire.vistas.with-login.lists.show-user-list', compact('list', 'userRegisters'));
    }

    // UPDATE

    public function openModal()
    {
        $list = CustomList::findOrFail($this->listId);
        $this->uform->setList($list);
        $this->showUpdateModal = true;
    }

    public function save()
    {
        $list = CustomList::findOrFail($this->listId);
        $this->uform->updateListForm($list);
        $this->showUpdateModal = false;

        $this->dispatch('notify', message: 'Lista actualizada', type: 'success');
    }

    public function cancel()
    {
        $this->uform->cancelForm();
        $this->showUpdateModal = false;
    }

    // DELETE

    public function deleteList()
    {
        $list = CustomList::findOrFail($this->listId);
        $list->delete();

        $this->dispatch('notify', message: 'Lista eliminada', type: 'success');

        return $this->redirect(route('userLists'), navigate: true);
    }

    public function deleteGameFromList($gameId)
    {
        $list = CustomList::findOrFail($this->listId);
        $list->games()->detach($gameId);

        $this->dispatch('notify', message: 'Juego eliminado de la lista', type: 'success');
    }
}
