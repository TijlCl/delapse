<?php
namespace App\Http\Actions;

use App\Http\Repositories\AchievementRepository;
use App\Models\User;

class AddRegisterUserAchievementsAction
{

    private AchievementRepository $achievementRepository;

    public function __construct(AchievementRepository $achievementRepository)
    {
        $this->achievementRepository = $achievementRepository;
    }

    /**
     * @param User $user
     * @param int $daysClean
     */
    public function execute(User $user, int $daysClean)
    {
        $achievements = $this->achievementRepository->getBelowDaysRequired($daysClean);
        $user->achievements()->syncWithoutDetaching($achievements);
    }
}
