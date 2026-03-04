<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $game = Game::inRandomOrder()->first() ?? Game::factory()->create();

        return [
            'user_id' => $user->id,
            'game_id' => $game->id,
            'body' => fake()->paragraphs(2, true),
            'score' => fake()->numberBetween(1, 10),
            'weight_applied' => $user->role === 'journalist' ? 3.0 : ($user->role === 'veteran' ? 1.5 : 1.0),
        ];
    }
}