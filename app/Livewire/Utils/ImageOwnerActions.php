<?php

namespace App\Livewire\Utils;

use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ImageOwnerActions extends Component
{
    public Image $image;

    public bool $confirmingDelete = false;

    public function mount(Image $image): void
    {
        $this->image = $image;
    }

    public function render()
    {
        return view('livewire.utils.image-owner-actions');
    }

    public function toggleSpoiler(): void
    {
        $this->authorize('update', $this->image);

        // Actualiza el estado spoiler de la captura
        $this->image->is_spoiler = !$this->image->is_spoiler;
        $this->image->save();

        // Limpia la caché de "Top capturas" para reflejar el cambio al instante
        Cache::forget('last_images_global_top_week');
        $gameSlug = $this->image->game()->value('slug');
        if ($gameSlug) {
            Cache::forget('last_images_game_top_week_' . $gameSlug);
        }

        // Fuerza re-render en vistas que muestran capturas galería, modal, previews)
        $this->dispatch('evtImagesRefresh');
        $this->dispatch('notify', message: 'Estado de spoiler actualizado.', type: 'success');
    }

    /* BORRAR */
    public function openDelete(): void
    {
        $this->authorize('delete', $this->image);

        $this->confirmingDelete = true;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->image);

        $imageId = $this->image->id;
        $gameSlug = $this->image->game()->value('slug');

        // Borra el archivo antes de eliminar el registro
        if ($this->image->image_path) {
            Storage::disk('public')->delete($this->image->image_path);
        }

        $this->image->delete();

        // Limpia caché y refresca la interfaz de usuario
        Cache::forget('last_images_global_top_week');
        if ($gameSlug) {
            Cache::forget('last_images_game_top_week_' . $gameSlug);
        }

        $this->confirmingDelete = false;
        $this->dispatch('evtImagesRefresh');
        $this->dispatch('notify', message: 'Imagen eliminada correctamente.', type: 'success');
        $this->dispatch('image-deleted', imageId: $imageId);
    }
}

