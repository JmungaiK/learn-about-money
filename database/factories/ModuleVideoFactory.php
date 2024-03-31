<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModuleVideo>
 */
class ModuleVideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get existing video and module IDs
        $moduleIds = \App\Models\Module::pluck('id')->toArray();
        $videoIds = \App\Models\Video::pluck('id')->toArray();

        // Make sure there are existing records to choose from
        if (empty($moduleIds) || empty($videoIds)) {
            throw new \Exception('No existing video or module records found.');
        }

        return [
            'module_id' => fake()->randomElement($moduleIds),
            'video_id' => fake()->randomElement($videoIds),
            'order_column' => $this->faker->randomNumber(2), // Generate a random number for order column
        ];
    }
}
