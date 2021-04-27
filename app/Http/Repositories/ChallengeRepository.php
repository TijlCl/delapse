<?php

namespace App\Http\Repositories;

use App\Models\Challenge;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ChallengeRepository extends BaseRepository
{

    /**
     * @param Challenge $model
     */
    public function __construct(Challenge $model)
    {
        parent::__construct($model);
    }

    public function getRandomWeeklyChallenges(int $userId): Collection
    {
        return Challenge::selectRaw('challenges.id')
            ->whereDoesntHave('users', function ($query) use ($userId) {
                $query->where('challenge_user.user_id', '=', $userId)
                    ->where('challenge_user.created_at', '>', Carbon::now()->subDays(15));
            })
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }
}
