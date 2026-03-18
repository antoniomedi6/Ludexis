<?php

namespace Database\Seeders;

use App\Models\CustomList;
use App\Models\Image;
use App\Models\Review;
use App\Models\User;
use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*         $this->call([
                    GenreSeeder::class,
                    PlatformSeeder::class,
                ]);
         */
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('contraseñadificil'),
            'role' => 'admin',
            'xp' => 0,
            'is_private' => false,
            'banned_at' => null,
        ]);
        $this->call(GameUserSeeder::class);

        $users = User::factory(30)->create();

        /*         Storage::deleteDirectory('images/gameCovers');
                Storage::createDirectory('images/gameCovers'); */
        Storage::deleteDirectory('images/userImages/');
        Storage::createDirectory('images/userImages/');

        /* $games = Game::factory(100)->create(); */
        $games = Game::all();

        foreach ($users as $user) {
            $userGames = $games->random(rand(3, 6));

            foreach ($userGames as $game) {
                DB::table('game_user')->insert([
                    'user_id' => $user->id,
                    'game_id' => $game->id,
                    'status' => fake()->randomElement(['pending, abandoned, finish, completed, multiplayer', 'paused', 'playing']),
                    'drop_reason' => fake()->optional(0.3)->sentence(),
                    'hours_finish' => 0,
                    'hours_completed' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if (fake()->boolean(50)) {
                    Review::factory()->create([
                        'user_id' => $user->id,
                        'game_id' => $game->id,
                    ]);
                }

                if (fake()->boolean(30)) {
                    Image::factory()->create([
                        'user_id' => $user->id,
                        'game_id' => $game->id,
                    ]);
                }
            }

            CustomList::factory(2)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}