<?php

namespace App\Http\Repositories;

use App\Http\DTO\SettingsDTO;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SettingsRepository extends BaseRepository
{

    /**
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @return Setting
     */
    public function findByUserId(int $userId): Setting
    {
        return Setting::where('user_id', $userId)->first();
    }

    /**
     * @param int $userId
     * @param SettingsDTO $settingsDTO
     * @return Setting
     */
    public function update(int $userId, SettingsDTO $settingsDTO): Setting
    {
        $settings = $this->findByUserId($userId);

        $settings->update([
            'enable_location' => $settingsDTO->enableLocation,
            'sponsor' => $settingsDTO->sponsor,
            'public_gallery' => $settingsDTO->publicGallery,
            'emergency_contact' => $settingsDTO->emergencyContact,
        ]);

        return $settings;
    }
}
