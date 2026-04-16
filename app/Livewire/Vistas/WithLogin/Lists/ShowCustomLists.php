<?php

namespace App\Livewire\Vistas\WithLogin\Lists;

use App\Livewire\Forms\Lists\CustomListForm;
use App\Models\CustomList;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCustomLists extends Component
{
    use WithPagination;

    public bool $showCreateModal = false;
    public string $search = '';
    public string $orderBy = 'updated_at';

    public CustomListForm $cform;

    public function render()
    {
        $orderDirection = $this->orderBy === 'name' ? 'asc' : 'desc';

        $userLists = CustomList::withCount('games')
            ->with([
                'games' => function ($query) {
                    $query->select('games.id', 'cover_url')->take(3);
                }
            ])
            ->where('user_id', auth()->id())
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy($this->orderBy, $orderDirection)
            ->paginate(15);

        return view('livewire.vistas.with-login.lists.show-custom-lists', compact('userLists'));
    }

    public function save()
    {
        $this->cform->saveForm();
        $this->cancel();
        $this->dispatch('notify', message: 'Lista Creada Correctamente', type: 'success');
    }

    public function cancel()
    {
        $this->cform->cancelForm();
        $this->showCreateModal = false;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}