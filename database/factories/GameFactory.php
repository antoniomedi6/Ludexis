<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'igdb_id' => fake()->unique()->numberBetween(1000, 999999),
            'title' => fake()->words(3, true),
            'synopsis' => fake()->paragraphs(3, true),
            'cover_image' => fake()->imageUrl(200, 300, 'games', true),
            'is_multiplayer' => fake()->boolean(40),
            'community_avg_time' => fake()->numberBetween(5, 100),
            'igdb_avg_time' => fake()->numberBetween(5, 100),
            'weighted_score' => fake()->randomFloat(1, 5, 9.5),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Game $game) {
            $genres = Genre::inRandomOrder()->limit(rand(1, 3))->get();
            $game->genres()->attach($genres);

            $platforms = Platform::inRandomOrder()->limit(rand(1, 4))->get();
            $game->platforms()->attach($platforms);
        });
    }
}