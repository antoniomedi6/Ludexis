<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            'PC',
            'PlayStation 5',
            'PlayStation 4',
            'Xbox Series X|S',
            'Xbox One',
            'Nintendo Switch',
            'Nintendo 3DS',
            'iOS',
            'Android',
            'macOS',
            'Linux',
            'Wii U',
            'PlayStation 3',
            'Xbox 360',
            'PlayStation Vita',
        ];

        foreach ($platforms as $platformName) {
            Platform::create(['name' => $platformName]);
        }
    }
}