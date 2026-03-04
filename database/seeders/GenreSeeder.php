<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Acción',
            'Aventura',
            'Rol',
            'Shooter',
            'Estrategia',
            'Deportes',
            'Carreras',
            'Simulación',
            'Puzzle',
            'Indie',
            'Lucha',
            'Terror',
            'Sandbox',
            'Plataformas',
            'Battle Royale',
            'Musical',
            'Party',
            'Educativo',
        ];

        foreach ($genres as $genreName) {
            Genre::create(['name' => $genreName]);
        }
    }
}