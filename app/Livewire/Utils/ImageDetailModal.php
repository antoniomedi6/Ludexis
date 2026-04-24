<?php

namespace App\Livewire\Utils;

use App\Models\Image;
use Livewire\Component;
use Livewire\Attributes\On;

class ImageDetailModal extends Component
{
    public ?Image $image = null;
    public bool $showModal = false;
    public ?int $imageId = null;

    #[On('open-image-detail')]
    public function loadModal($imageId)
    {
        $this->imageId = $imageId;
        $this->image = Image::with(['user', 'game'])->findOrFail($imageId);
        $this->showModal = true;
    }

    #[On('evtImagesRefresh')]
    public function refreshImage(): void
    {
        // Si la modal no está abierta, no hacemos nada
        if (!$this->showModal || !$this->imageId) {
            return;
        }

        // Recarga la modal o cierra si fue eliminada
        $this->image = Image::with(['user', 'game'])->find($this->imageId);

        if (!$this->image) {
            $this->closeModal();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->image = null;
        $this->imageId = null;
    }

    public function render()
    {
        return view('livewire.utils.image-detail-modal');
    }
}
