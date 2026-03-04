<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    public function definition(): array
    {
        $likeable = fake()->randomElement([
            Review::factory()->create(),
            Image::factory()->create(),
        ]);

        return [
            'user_id' => User::factory(),
            'likeable_id' => $likeable->id,
            'likeable_type' => get_class($likeable),
        ];
    }
}