<?php

namespace App\Livewire\Utils;

use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class PreviewImages extends Component
{
    public ?string $gameSlug = null;

    public function mount(?string $gameSlug = null)
    {
        $this->gameSlug = $gameSlug;
    }

    #[On('evtImagesRefresh')]
    public function refreshImages(): void
    {
        Cache::forget('last_images_global_top_week');
        if ($this->gameSlug) {
            Cache::forget('last_images_game_top_week_' . $this->gameSlug);
        }
    }

    public function render()
    {
        if (!$this->gameSlug) {
            // Las capturas con más likes del último mes
            $images = Cache::remember('last_images_global_top_week', 300, function () {
                return Image::with(['user:id,name,profile_photo_path'])
                    ->withCount('likes') // Genera una columna virtual 'likes_count'
                    ->where('is_spoiler', false)
                    // ->where('created_at', '>=', now()->subMonth())
                    ->orderByDesc('likes_count') // Ordenamos por la columna virtual
                    ->latest()
                    ->limit(7)
                    ->get(['id', 'user_id', 'game_id', 'image_path', 'created_at']);
            });
        } else {
            // Las imágenes con más likes del último mes de ese juego
            $images = Cache::remember('last_images_game_top_week_' . $this->gameSlug, 300, function () {
                return Image::with(['user:id,name,profile_photo_path'])
                    ->withCount('likes')
                    ->where('is_spoiler', false)
                    // ->where('created_at', '>=', now()->subMonth())
                    ->whereHas('game', function ($q) {
                        $q->where('slug', $this->gameSlug);
                    })
                    ->orderByDesc('likes_count')
                    ->latest()
                    ->limit(7)
                    ->get(['id', 'user_id', 'game_id', 'image_path', 'created_at']);
            });
        }

        return view('livewire.utils.preview-images', compact('images'));
    }
}
