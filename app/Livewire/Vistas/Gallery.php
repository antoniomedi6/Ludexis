<?php

namespace App\Livewire\Vistas;

use App\Models\Image;
use Livewire\Component;

class Gallery extends Component
{
    public function render()
    {
        $images = Image::with(['game', 'user'])
            ->get();
        return view('livewire.vistas.gallery', compact('images'));
    }
}