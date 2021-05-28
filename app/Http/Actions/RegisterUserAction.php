<?php
namespace App\Http\Actions;

use App\Http\DTO\RegisterUserDTO;
use App\Http\DTO\SettingsDTO;
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

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, SettingsRepository $settingsRepository)
    {
        $this->userRepository = $userRepository;
        $this->settingsRepository = $settingsRepository;
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
    }
}
