<?php

namespace App\Livewire\Forms;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ImageForm extends Form
{
    #[Validate(['required', 'exists:games,id'])]
    public ?int $game_id = null;

    #[Validate(['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'])]
    public ?TemporaryUploadedFile $image_path = null;

    #[Validate(['required', 'boolean'])]
    public bool $is_spoiler = false;

    public function saveForm()
    {
        $datos = $this->validate();

        $datos['user_id'] = Auth::id();
        $datos['image_path'] = $this->image_path->store('images/userImages', 'public');

        Image::create($datos);

        $this->cancelForm();
    }

    public function cancelForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}