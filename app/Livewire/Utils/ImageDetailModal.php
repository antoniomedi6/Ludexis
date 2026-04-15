<?php

namespace App\Livewire\Utils;

use App\Models\Image;
use Livewire\Component;
use Livewire\Attributes\On;

class ImageDetailModal extends Component
{
    public ?Image $image = null;
    public bool $showModal = false;

    #[On('open-image-detail')]
    public function loadModal($imageId)
    {
        $this->image = Image::with(['user', 'game'])->findOrFail($imageId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.utils.image-detail-modal');
    }
}