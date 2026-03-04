<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'game_id' => Game::factory(),
            'image_path' => 'images/' . fake()->uuid() . '.jpg',
            'is_spoiler' => fake()->boolean(10),
        ];
    }
}