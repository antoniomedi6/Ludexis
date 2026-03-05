<?php

namespace App\Livewire\Utils;

use App\Models\Image;
use Cache;
use Livewire\Component;

class PreviewImages extends Component
{
    public function render()
    {
        $lastImages = Cache::remember('last_images', 300, function () {
            return Image::with(['user:id,name,profile_photo_path'])
                ->where('is_spoiler', false)
                ->latest()
                ->limit(7)
                ->get(['id', 'user_id', 'game_id', 'image_path', 'created_at']);
        });
        return view('livewire.utils.preview-images', compact('lastImages'));
    }
}