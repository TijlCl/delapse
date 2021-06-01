<?php

namespace App\Http\Repositories;

use App\Http\DTO\CheckInDTO;
use App\Models\CheckIn;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param int $userId
     * @return Collection
     */
    public function getAll(int $userId, Carbon $from, Carbon $to): Collection
    {
        return CheckIn::where('user_id', $userId)
            ->whereBetween('created_at', [$from, $to])
            ->orderByDesc('created_at')
            ->get();
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
