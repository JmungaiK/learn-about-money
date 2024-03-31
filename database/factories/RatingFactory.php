<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get existing video and user IDs
        $userIds = User::pluck('id')->toArray();
        $videoIds = Video::pluck('id')->toArray();

        // Make sure there are existing records to choose from
        if (empty($userIds) || empty($videoIds)) {
            throw new \Exception('No existing video or user records found.');
        }

        return [
            'rating' => fake()->randomFloat(0, 1, 5), // Generate a random rating between 1 and 5 with 1 decimal places
            'user_id' => fake()->randomElement($userIds),
            'video_id' => fake()->randomElement($videoIds),


            //            'rating' => fake()->randomFloat(0, 1, 5), // Generate a random rating between 1 and 5 with 1 decimal places
            //          'user_id' => \App\Models\User::factory(), // Create a user ID using UserFactory
            //        'video_id' => \App\Models\Video::factory(), // Create a video ID using VideoFactory if available
        ];
    }
}
