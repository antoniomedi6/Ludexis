<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;

class GameUserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() === 0) {
            User::factory(10)->create();
        }

        $users = User::all();
        $games = Game::all();

        if ($games->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $randomGames = $games->random(min($games->count(), rand(5, 15)));

            foreach ($randomGames as $game) {
                $user->games()->attach($game->id, [
                    'review' => fake()->boolean(70) ? fake()->realTextBetween() : null,
                    'weight_applied' => match ($user->role) {
                        'admin', 'journalist' => 3,
                        'veteran' => 1.5,
                        default => 1,
                    },
                    'rating' => fake()->numberBetween(1, 10),
                    'status' => fake()->randomElement(['pending', 'abandoned', 'finish', 'completed', 'multiplayer', 'paused', 'playing']),
                    'drop_reason' => fake()->optional(0.3)->sentence(),
                    'hours_finish' => fake()->randomFloat(2, 0, 100),
                    'created_at' => now()->subDays(rand(0, 6)),
                    'updated_at' => now()->subDays(rand(0, 6)),
                ]);
            }
        }
    }
}