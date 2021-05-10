<?php

namespace App\Http\Repositories;

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

    public function findByUserId(int $userId)
    {
        return Setting::where('user_id', $userId)->first();
    }
}
