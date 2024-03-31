<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(rand(10, 50)),
            'description' => fake()->realText(200),
            'thumbnail' => fake()->imageUrl(),
            'youtube_url' => fake()->url,
            'duration' => fake()->time('H:i:s'), // Generates a random time in HH:MM:SS format
        ];
    }
}
