<?php

namespace App\Livewire\Utils;

use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PreviewImages extends Component
{
    public ?string $gameSlug = null;

    public function mount(?string $gameSlug = null)
    {
        $this->gameSlug = $gameSlug;
    }

    public function render()
    {
        if (!$this->gameSlug) {
            $images = Cache::remember('last_images_global', 300, function () {
                return Image::with(['user:id,name,profile_photo_path'])
                    ->where('is_spoiler', false)
                    ->latest()
                    ->limit(7)
                    ->get(['id', 'user_id', 'game_id', 'image_path', 'created_at']);
            });
        } else {
            $images = Cache::remember('last_images_game_' . $this->gameSlug, 300, function () {
                return Image::with(['user:id,name,profile_photo_path'])
                    ->where('is_spoiler', false)
                    ->whereHas('game', function ($query) {
                        $query->where('slug', $this->gameSlug);
                    })
                    ->latest()
                    ->limit(7)
                    ->get(['id', 'user_id', 'game_id', 'image_path', 'created_at']);
            });
        }

        return view('livewire.utils.preview-images', compact('images'));
    }
}