<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    public function definition(): array
    {
        $reportable = fake()->randomElement([
            User::factory()->create(),
            Review::factory()->create(),
            Image::factory()->create(),
        ]);

        return [
            'user_id' => User::factory(),
            'reportable_id' => $reportable->id,
            'reportable_type' => get_class($reportable),
            'reason' => fake()->sentence(),
            'status' => fake()->randomElement(['pendiente', 'resuelto']),
        ];
    }
}