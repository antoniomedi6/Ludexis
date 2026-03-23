<?php

namespace App\Livewire;

use Livewire\Component;

class Playground extends Component
{
    public function render()
    {
        $this->dispatch('evtOpenReviewModal', gameId: 1);
        return view('livewire.playground');
    }
}