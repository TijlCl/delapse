<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ChallengeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('id', 1)->first();

        $challenges = Challenge::all();
        $challenges = $challenges->pluck('id')->toArray();

        $user->challenges()->syncWithPivotValues($challenges, ['completed_at' => Carbon::now()]);
    }
}
