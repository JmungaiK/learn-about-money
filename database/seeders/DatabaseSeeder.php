<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Module;
use App\Models\ModuleVideo;
use App\Models\Progress;
use App\Models\Rating;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\QueryException;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => '1',
        ]);

        // Create a moderator user
        User::factory()->create([
            'name' => 'Mod',
            'email' => 'mod@example.com',
            'role' => '2',
        ]);

        // Create 10 normal users
        User::factory(10)->create([
            'role' => '3',
        ]);

        //create 50 videos
        Video::factory(50)->create();

        //create 250 comments
        Comment::factory(2500)->create();

        //create 10 modules
        Module::factory(10)->create();

        //create 50 mappings
        ModuleVideo::factory(50)->create();

        //create 500 progress
        Progress::factory(500)->create();

        try {
            // Attempt to seed ratings
            Rating::factory(250)->create();
        } catch (QueryException $e) {
            // Handle unique constraint violation
            $this->command->warn('Caught UniqueConstraintViolationException while seeding ratings.');

            // Optionally, you can retry the seeding process or skip the insertion of duplicate ratings
            // Retry the seeding process
            // $this->run();

            // Skip the insertion of duplicate ratings
            $this->command->warn('Skipping the insertion of duplicate ratings.');
        }
    }
}
