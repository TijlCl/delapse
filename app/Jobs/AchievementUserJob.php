<?php

namespace App\Jobs;

use App\Http\Repositories\SoberCounterRepository;
use App\Models\Achievement;
use App\Models\SoberCounter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AchievementUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Achievement $achievement;

    /**
     * Create a new job instance.
     *
     * @param Achievement $achievement
     */
    public function __construct(Achievement $achievement)
    {
        $this->achievement = $achievement;
    }

    /**
     * Execute the job.
     *
     * @param SoberCounterRepository $soberCounterRepository
     * @return void
     */
    public function handle(SoberCounterRepository $soberCounterRepository)
    {
        $soberCounters = $soberCounterRepository->getByDaysClean($this->achievement['days_required'], ['user']);

        foreach ($soberCounters as $soberCounter) {
            $soberCounter->user->achievements()->attach($this->achievement);
        }
    }
}
