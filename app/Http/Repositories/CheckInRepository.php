<?php

namespace App\Http\Repositories;

use App\Http\DTO\CheckInDTO;
use App\Http\DTO\SettingsDTO;
use App\Models\CheckIn;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CheckInRepository extends BaseRepository
{

    /**
     * @param CheckIn $model
     */
    public function __construct(CheckIn $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @return CheckIn
     */
    public function findByUserId(int $userId): CheckIn
    {
        return CheckIn::where('user_id', $userId)->first();
    }

    public function newCheckIn(int $userId, CheckInDTO $DTO): CheckIn
    {
        $checkIn = new CheckIn([
           'mood' => $DTO->mood,
           'emoji' => $DTO->emoji,
           'description' => $DTO->description,
           'tags' => $DTO->tags
        ]);
        $checkIn->user()->associate($userId);
        $checkIn->save();
        return $checkIn;
    }

    public function getWeeklyForUser(int $userId, Carbon $start, Carbon $end)
    {
        return CheckIn::where('user_id', $userId)
            ->whereBetween('created_at', [$start, $end])
            ->get();
    }
}
