<?php

namespace App\Jobs;

use App\Http\Repositories\AchievementRepository;
use App\Http\Repositories\SoberCounterRepository;
use App\Models\Achievement;
use App\Models\SoberCounter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AchievementsUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param AchievementRepository $achievementRepository
     * @return void
     */
    public function handle(AchievementRepository $achievementRepository)
    {
        $achievementRepository->all()->each(function (Achievement $achievement){
            AchievementUserJob::dispatch($achievement);
        });
    }
}
