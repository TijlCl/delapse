<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param User $user
     * @param Collection $challenges
     */
    public function addWeeklyChallenges(User $user, Collection $challenges)
    {
        $user->challenges()->attach($challenges);
    }

    /**
     * @param string $username
     * @return Collection
     */
    public function getByUsername(string $username): Collection
    {
        return User::where('name', 'LIKE', '%' . $username . '%')
            ->where('id', '<>', Auth::id())
            ->get();
    }
}
