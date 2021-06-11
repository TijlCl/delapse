<?php

namespace Database\Seeders;

use App\Http\Repositories\ChallengeRepository;
use App\Http\Repositories\UserRepository;
use App\Models\Challenge;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ªChallengeUserSeeder extends Seeder
{

    private $challengeRepository;
    private $userRepository;

    public function __construct(ChallengeRepository $challengeRepository, UserRepository $userRepository)
    {
        $this->challengeRepository = $challengeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //give user completed challenges
        $user = User::where('id', 1)->first();

        $challenges = Challenge::all();
        $challenges = $challenges->pluck('id')->toArray();

        $user->challenges()->syncWithPivotValues($challenges, ['completed_at' => Carbon::now()]);

        // give user uncompleted challenges
        $weeklyChallenges = Challenge::inRandomOrder()
            ->limit(3)
            ->get();

        $this->userRepository->addWeeklyChallenges($user, $weeklyChallenges);
    }
}
