<?php

namespace Database\Seeders;

use App\Models\CustomList;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* $this->call([
                    GenreSeeder::class,
                    PlatformSeeder::class,
                ]);
         */
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('contraseñadificil'),
                'role' => 'admin',
                'xp' => 0,
                'is_private' => false,
                'banned_at' => null,
            ]
        );

        User::factory(30)->create();

        $this->call(GameUserSeeder::class);

        /* Storage::deleteDirectory('images/gameCovers');
                Storage::createDirectory('images/gameCovers'); */
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