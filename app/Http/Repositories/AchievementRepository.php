<?php

namespace App\Http\Repositories;

use App\Models\Achievement;
use App\Models\Friend;

class AchievementRepository extends BaseRepository
{

    /**
     * @param Achievement $model
     */
    public function __construct(Achievement $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByUser(int $userId, array $with = [])
    {
        return Achievement::with($with)
            ->whereHas('user', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->get();
    }
}
