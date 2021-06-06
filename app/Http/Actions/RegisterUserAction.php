<?php
namespace App\Http\Actions;

use App\Http\DTO\RegisterUserDTO;
use App\Http\DTO\SettingsDTO;
use App\Http\Repositories\AchievementRepository;
use App\Http\Repositories\SettingsRepository;
use App\Http\Repositories\UserRepository;
use App\Models\Setting;
use App\Models\SoberCounter;

class RegisterUserAction
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    private SettingsRepository $settingsRepository;
    private AchievementRepository $achievementRepository;
    private AddRegisterUserAchievementsAction $addRegisterUserAchievementsAction;

    /**
     * @param UserRepository $userRepository
     * @param SettingsRepository $settingsRepository
     * @param AchievementRepository $achievementRepository
     * @param AddRegisterUserAchievementsAction $addRegisterUserAchievementsAction
     */
    public function __construct(UserRepository $userRepository,
                                SettingsRepository $settingsRepository,
                                AchievementRepository $achievementRepository,
                                AddRegisterUserAchievementsAction $addRegisterUserAchievementsAction)
    {
        $this->userRepository = $userRepository;
        $this->settingsRepository = $settingsRepository;
        $this->achievementRepository = $achievementRepository;
        $this->addRegisterUserAchievementsAction = $addRegisterUserAchievementsAction;
    }

    /**
     * @param RegisterUserDTO $registerUserDTO
     * @param SettingsDTO $settingsDTO
     * @param int $daysClean
     */
    public function execute(RegisterUserDTO $registerUserDTO, SettingsDTO $settingsDTO, int $daysClean)
    {
        $user = $this->userRepository->create($registerUserDTO->toArray());

        $settings = new Setting([
            'enable_location' => $settingsDTO->enableLocation,
            'sponsor' => $settingsDTO->sponsor,
            'public_gallery' => $settingsDTO->publicGallery,
            'emergency_contact' => $settingsDTO->emergencyContact,
        ]);

        // add user settings
        $user->setting()->save($settings);

        // add sober counter
        $user->soberCounter()->save(new SoberCounter([
            'days_clean' => $daysClean
        ]));

        // add achievements

        // add create account achievement
        $firstAchievement = $this->achievementRepository->getByTitle('Start your delapse journey!');
        $user->achievements()->attach($firstAchievement);

        $this->addRegisterUserAchievementsAction->execute($user, $daysClean);
    }
}
