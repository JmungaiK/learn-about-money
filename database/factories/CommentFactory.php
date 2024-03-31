<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'comment' => fake()->realText(rand(20, 200)), //Generate a random text between 20 and 200 characters
            'user_id' => fake()->randomElement($userIds),
            'video_id' => fake()->randomElement($videoIds),

            // 'comment' => fake()->sentence,
            // 'user_id' => \App\Models\User::factory(), // Create a user ID using UserFactory
            // 'video_id' => \App\Models\Video::factory(), // Create a video ID using VideoFactory
        ];
    }
}
