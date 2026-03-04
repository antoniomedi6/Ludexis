<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Game;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        $activable = fake()->randomElement([
            Game::factory()->create(),
            Review::factory()->create(),
            Image::factory()->create(),
        ]);

        return [
            'user_id' => User::factory(),
            'activable_id' => $activable->id,
            'activable_type' => get_class($activable),
            'action_type' => fake()->randomElement([
                'started_playing',
                'uploaded_image',
                'wrote_review',
                'added_to_list',
                'made_friend'
            ]),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}