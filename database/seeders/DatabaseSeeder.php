<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ImageSeeder::class,
            ChallengeSeeder::class,
            AchievementSeeder::class,
            AuthClientSeeder::class,
            TestUserSeeder::class,
            CheckInUserSeeder::class,
            ChallengeUserSeeder::class,
        ]);
    }
}
