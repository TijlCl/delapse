<?php

namespace App\Http\Repositories;

use App\Http\DTO\ChallengeUserDTO;
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

    /**
     * @param int $userId
     * @param array $with
     * @return Collection
     */
    public function getCompletedChallenges(int $userId, array $with = []): Collection
    {
        return ChallengeUser::with($with)
            ->where('user_id', $userId)
            ->where('completed_at', '!=', null)
            ->get();
    }

    /**
     * @param ChallengeUserDTO $challengeUserDTO
     */
    public function completeChallenge(ChallengeUserDTO $challengeUserDTO)
    {
        /*ChallengeUser::where('id', $challengeUserDTO->id)->update([
            'description' => $challengeUserDTO->description,
            'image' => $challengeUserDTO->image,
            'completed_at' => $challengeUserDTO->completedAt,
        ]);*/

        $challengeUser = $this->find($challengeUserDTO->id);

        $challengeUser->fill([
            'description' => $challengeUserDTO->description,
            'image' => $challengeUserDTO->image,
            'completed_at' => $challengeUserDTO->completedAt,
        ]);

        $challengeUser->save();

        return $challengeUser;
    }
}
