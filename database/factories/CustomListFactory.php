<?php

namespace Database\Factories;

use App\Models\CustomList;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomListFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(2, true),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (CustomList $list) {
            $games = Game::inRandomOrder()->limit(rand(2, 5))->get();
            $list->games()->attach($games);
        });
    }
}