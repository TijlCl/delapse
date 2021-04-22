<?php

namespace App\Http\Repositories;

use App\Models\Friend;

class FriendRepository extends BaseRepository
{

    /**
     * @param Friend $model
     */
    public function __construct(Friend $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getFriendsOfUser(int $userId, array $with = ['friend', 'chat.lastMessage'])
    {
        return Friend::with($with)
            ->where('user_id', $userId)
            ->get();
    }
}
