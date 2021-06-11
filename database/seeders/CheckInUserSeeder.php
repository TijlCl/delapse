<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\CheckIn;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CheckInUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CheckIn::insert([
            [
                'user_id' => 1,
                'mood' => 'Happy',
                'emoji' => '&#128522;',
                'description' => 'I was very happy',
                'tags' => 'Work, Love, School',
                'created_at' => Carbon::now()->subDays(7)
            ],
            [
                'user_id' => 1,
                'mood' => 'Happy',
                'emoji' => '&#128522;',
                'description' => 'I was very happy',
                'tags' => 'Work, Love, School',
                'created_at' => Carbon::now()->subDays(6)
            ],
            [
                'user_id' => 1,
                'mood' => 'Tired',
                'emoji' => '&#128564;',
                'description' => 'I was very tired',
                'tags' => 'Work, Love, School',
                'created_at' => Carbon::now()->subDays(5)
            ],
            [
                'user_id' => 1,
                'mood' => 'Tired',
                'emoji' => '&#128564;',
                'description' => 'I was very tired',
                'tags' => 'Work, Love, School',
                'created_at' => Carbon::now()->subDays(4)
            ],
            [
                'user_id' => 1,
                'mood' => 'Tired',
                'emoji' => '&#128564;',
                'description' => 'I was very tired',
                'tags' => 'Work, Love, School',
                'created_at' => Carbon::now()->subDays(3)
            ],
            [
                'user_id' => 1,
                'mood' => 'Happy',
                'emoji' => '&#128522;',
                'description' => 'I was very happy',
                'tags' => 'Work, Love, School',
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'user_id' => 1,
                'mood' => 'Happy',
                'emoji' => '&#128522;',
                'description' => 'I was very happy',
                'tags' => 'Work, Love, School',
                'created_at' => Carbon::now()->subDays(1)
            ],
        ]);
    }
}
