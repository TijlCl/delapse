<?php

namespace App\Http\Repositories;

use App\Models\Challenge;
use App\Models\ChallengeUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ChallengeUserRepository extends BaseRepository
{

    /**
     * @param ChallengeUser $model
     */
    public function __construct(ChallengeUser $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param array $with
     * @return Collection
     */
    public function getWeeklyChallenges(int $userId, array $with = []): Collection
    {
        return ChallengeUser::with($with)
            ->where('user_id', $userId)
            ->where('invalid_at', '>=', Carbon::now())
            ->get();
    }
}