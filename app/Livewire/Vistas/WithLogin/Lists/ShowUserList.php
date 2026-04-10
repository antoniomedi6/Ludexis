<?php

namespace App\Livewire\Vistas\WithLogin\Lists;

use App\Models\CustomList;
use Livewire\Component;

class ShowUserList extends Component
{
    public CustomList $list;

    public function mount(CustomList $list)
    {
        abort_if($list->user_id !== auth()->id(), 403);

        $this->list = $list->loadCount('games')->load('games');
    }

    public function render()
    {
        return view('livewire.vistas.with-login.lists.show-user-list');
    }
}