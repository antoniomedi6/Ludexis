<?php

namespace App\Livewire\Forms\Vistas\WithLogin\Lists;

use App\Models\CustomList;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateListForm extends Form
{
    #[Validate('required|min:3|max:50')]
    public string $name = '';

    public function setList(CustomList $list)
    {
        $this->name = $list->name;
    }

    public function updateListForm(CustomList $list)
    {
        $this->validate();
        $list->update(['name' => $this->name]);
    }

    public function cancelForm()
    {
        $this->reset();
        $this->resetValidation();
    }
}