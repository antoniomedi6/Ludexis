<?php

namespace App\Livewire\Forms\Lists;

use App\Models\CustomList;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomListForm extends Form
{
    #[Validate('required|min:3|max:50')]
    public string $name = '';

    public function saveForm()
    {
        $userId = auth()->id();
        $data = $this->validate();
        $data['user_id'] = $userId;
        CustomList::create($data);
    }

    public function cancelForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}