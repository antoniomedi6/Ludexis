<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdatePrivacyForm extends Component
{
    public $is_private;

    public function mount()
    {
        $this->is_private = Auth::user()->is_private;
    }

    public function updatePrivacy()
    {
        $user = Auth::user();
        $user->is_private = $this->is_private;
        $user->save();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.profile.update-privacy-form');
    }
}