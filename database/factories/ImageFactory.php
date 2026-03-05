<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use App\Models\Game;
use Bilions\FakerImages\FakerImageProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        fake()->addProvider(new FakerImageProvider(fake()));
        $image = fake()->image(sys_get_temp_dir(), 640, 480);

        return [
            'user_id' => User::factory(),
            'game_id' => Game::factory(),
            'image_path' => Storage::putFileAs('images/userImages/', new File($image), basename($image)),
            'is_spoiler' => fake()->boolean(10),
        ];
    }
}