<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use Bilions\FakerImages\FakerImageProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class GameFactory extends Factory
{
    public function definition(): array
    {
        fake()->addProvider(new FakerImageProvider(fake()));
        $image = fake()->image(sys_get_temp_dir(), 640, 480);

        return [
            'igdb_id' => fake()->unique()->numberBetween(1000, 999999),
            'title' => fake()->words(3, true),
            'synopsis' => fake()->paragraphs(3, true),
            'cover_image' => Storage::putFileAs('images/gameCovers/', new File($image), basename($image)),
            'avg_time' => fake()->numberBetween(5, 100),
            'rating' => fake()->randomFloat(1, 5, 9.5),
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