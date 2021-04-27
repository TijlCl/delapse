<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function addWeeklyChallenges(User $user, Collection $challenges)
    {
        $user->challenges()->attach($challenges);
    }
}
