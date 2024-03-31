<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'module' => fake()->realText(rand(10, 30)), //Generate a random text between 10 and 30 characters
            'description' => fake()->realText(rand(20, 200)), //Generate a random text between 20 and 200 characters
        ];
    }
}
