<?php

namespace App\Http\Repositories;

use App\Http\DTO\FriendDTO;
use App\Models\Friend;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
            ->whereNotNull('accepted_at')
            ->get();
    }


    /**
     * @param int $userId
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getFriendRequestsOfUser(int $userId, array $with = ['user'])
    {
        return Friend::with($with)
            ->where('friend_id', $userId)
            ->where('is_help', '=', 0)
            ->whereNull('accepted_at')
            ->get();
    }

    /**
     * @param int $userId
     * @param int $friendId
     * @param array $with
     * @return Friend
     */
    public function findByFriendAndUser(int $userId, int $friendId, array $with = []): Friend
    {
        return Friend::with($with)
            ->where('user_id', $userId)
            ->where('friend_id', $friendId)
            ->first();
    }

    /**
     * @param FriendDTO $friendDTO
     * @return Friend
     */
    public function request(FriendDTO $friendDTO, bool $isHelp = false)
    {
        $friend = new Friend([
            'is_help' => $isHelp
        ]);
        $friend->user()->associate($friendDTO->userId);
        $friend->friend()->associate($friendDTO->friendId);
        $friend->save();
        return $friend;
    }

    /**
     * @param Friend $friend
     * @param int $chatId
     * @return mixed
     */
    public function acceptRequest(Friend $friend, int $chatId)
    {
        $friend->accepted_at = Carbon::now();
        $friend->chat()->associate($chatId);
        $friend->save();
        return $friend;
    }

    /**
     * @param FriendDTO $friendDTO
     * @return Friend
     */
    public function createInverse(FriendDTO $friendDTO)
    {
        $friend = new Friend();
        $friend->accepted_at = Carbon::now();
        $friend->user()->associate($friendDTO->userId);
        $friend->friend()->associate($friendDTO->friendId);
        $friend->chat()->associate($friendDTO->chatId);
        $friend->save();
        return $friend;
    }
}
