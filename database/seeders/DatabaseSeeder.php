<?php

namespace Database\Seeders;

use App\Models\CustomList;
use App\Models\Image;
use App\Models\User;
use App\Services\PopularGamesImportService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\GameUserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* Crea un usuario admin */
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'role' => 'admin',
                'xp' => 0,
                'is_private' => false,
                'banned_at' => null,
                'email_verified_at' => now(),
            ]
        );

        /* Crea un usuario estándar */
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'user',
                'password' => Hash::make(env('DEFAULT_USER_PASSWORD')),
                'role' => 'standard',
                'xp' => 9999,
                'is_private' => false,
                'banned_at' => null,
                'email_verified_at' => now(),
            ]
        );

        /* Crea un usuario periodista */
        User::firstOrCreate(
            ['email' => 'journalist@example.com'],
            [
                'name' => 'journalist',
                'password' => Hash::make(env('DEFAULT_USER_PASSWORD')),
                'role' => 'journalist',
                'xp' => 0,
                'is_private' => false,
                'banned_at' => null,
                'email_verified_at' => now(),
            ]
        );

        User::factory(30)->create();

        /* app crea una instancia de la clase PopularGamesImportService y se trae los 100 juegos más populares de IGDB */
        app(PopularGamesImportService::class)->importPopular(100);

        $this->call(GameUserSeeder::class);

        Storage::deleteDirectory('images/userImages/');
        Storage::createDirectory('images/userImages/');

        $users = User::all();

        foreach ($users as $user) {
            foreach ($user->games as $game) {
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