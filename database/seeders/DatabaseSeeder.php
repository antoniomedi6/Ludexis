<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\CustomList;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Datos maestros (imprescindibles)
        $this->call([
            GenreSeeder::class,
            PlatformSeeder::class,
        ]);

        // 2. Usuario admin y 5 usuarios normales
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'xp' => 0,
            'is_private' => false,
            'banned_at' => null,
        ]);

        $users = User::factory(5)->create();

        // 3. 10 juegos de prueba
        $games = Game::factory(10)->create();

        // Asignar géneros y plataformas aleatorios
        $genres = Genre::all();
        $platforms = Platform::all();
        foreach ($games as $game) {
            $game->genres()->attach($genres->random(rand(1, 3))->pluck('id'));
            $game->platforms()->attach($platforms->random(rand(1, 3))->pluck('id'));
        }

        // 4. Cada usuario añade juegos a su biblioteca
        foreach ($users as $user) {
            $userGames = $games->random(rand(3, 6));
            foreach ($userGames as $game) {
                DB::table('game_user')->insert([
                    'user_id' => $user->id,
                    'game_id' => $game->id,
                    'status' => fake()->randomElement(['jugando', 'pendiente', 'completado', 'abandonado']),
                    'drop_reason' => fake()->optional(0.3)->sentence(),
                    'hours_played' => fake()->numberBetween(0, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 50% reseña
                if (fake()->boolean(50)) {
                    Review::create([
                        'user_id' => $user->id,
                        'game_id' => $game->id,
                        'body' => fake()->paragraphs(2, true),
                        'score' => fake()->numberBetween(1, 10),
                        'weight_applied' => $user->role === 'periodista' ? 3.0 : ($user->role === 'veterano' ? 1.5 : 1.0),
                    ]);
                }

                // 30% imagen
                if (fake()->boolean(30)) {
                    Image::create([
                        'user_id' => $user->id,
                        'game_id' => $game->id,
                        'image_path' => 'images/' . fake()->uuid() . '.jpg',
                        'is_spoiler' => fake()->boolean(10),
                    ]);
                }
            }

            // 2 listas por usuario
            for ($i = 0; $i < 2; $i++) {
                $list = CustomList::create([
                    'user_id' => $user->id,
                    'name' => fake()->words(2, true),
                ]);
                $list->games()->attach($games->random(rand(2, 4))->pluck('id'));
            }
        }
    }
}