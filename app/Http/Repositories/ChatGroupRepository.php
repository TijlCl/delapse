<?php

namespace App\Http\Repositories;

use App\Http\DTO\ChatDTO;
use App\Http\DTO\ChatMesssageDTO;
use App\Models\Chat;
use App\Models\ChatGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ChatGroupRepository extends BaseRepository
{

    /**
     * @param ChatGroup $model
     */
    public function __construct(ChatGroup $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param int $contactId
     * @param array $with
     * @return Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getByUser(int $userId, array $with = [])
    {
        return ChatGroup::with($with)->whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->get();
    }

    /**
     * @param int $userId
     * @param array $friends
     * @return Model
     */
    public function createChatGroup(int $userId, array $friends): Model
    {
        $chat = new ChatGroup();
        $chat->save();
        $chat->users()->attach($userId);
        $chat->users()->attach($friends);
        return $chat;
    }

    /**
     * @param int $chatId
     * @param int $userId
     * @return Model
     */
    public function addUser(int $chatId, int $userId): Model
    {
        $chat = $this->find($chatId);
        $chat->users()->attach($userId);
        return $chat;
    }
}
