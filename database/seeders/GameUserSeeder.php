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
                    'created_at' => now()->subDays(rand(0, 6)),
                    'updated_at' => now()->subDays(rand(0, 6)),
                ]);
            }
        }
    }
}