<?php

namespace App\Livewire\Utils;

use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PreviewImages extends Component
{
    public $gameId;

    public function mount(?int $gameId = null)
    {
        $this->gameId = $gameId;
    }

    public function render()
    {
        if (!$this->gameId) {
            $images = Cache::remember('last_images_global', 300, function () {
                return Image::with(['user:id,name,profile_photo_path'])
                    ->where('is_spoiler', false)
                    ->latest()
                    ->limit(7)
                    ->get(['id', 'user_id', 'game_id', 'image_path', 'created_at']);
            });
        } else {
            $images = Cache::remember('last_images_game_' . $this->gameId, 300, function () {
                return Image::with(['user:id,name,profile_photo_path'])
                    ->where('is_spoiler', false)
                    ->where('game_id', $this->gameId)
                    ->latest()
                    ->limit(7)
                    ->get(['id', 'user_id', 'game_id', 'image_path', 'created_at']);
            });
        }

        return view('livewire.utils.preview-images', compact('images'));
    }
}