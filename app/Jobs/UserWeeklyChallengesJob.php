<?php

namespace App\Jobs;

use App\Http\Repositories\ChallengeRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserWeeklyChallengesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $userId;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @param ChallengeRepository $challengeRepository
     * @param UserRepository $userRepository
     * @return void
     */
    public function handle(ChallengeRepository $challengeRepository, UserRepository $userRepository)
    {
        $newWeeklyChallenges = $challengeRepository->getRandomWeeklyChallenges($this->userId);
        $user = $userRepository->find($this->userId);

        $userRepository->addWeeklyChallenges($user, $newWeeklyChallenges);
    }
}
