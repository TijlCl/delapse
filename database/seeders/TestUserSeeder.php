<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\Image;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Tom',
                'email' => 'test@delapse.be',
                'password' => Hash::make('testAccount123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        Setting::insert([
            [
                'user_id' => 1,
                'enable_location' => 1,
                'sponsor' => 1,
                'public_gallery' => 1,
                'emergency_contact' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
