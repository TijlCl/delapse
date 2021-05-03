<?php

namespace App\Http\Repositories;

use App\Http\DTO\ChatDTO;
use App\Http\DTO\ChatMesssageDTO;
use App\Models\Chat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ChatRepository extends BaseRepository
{

    /**
     * @param Chat $model
     */
    public function __construct(Chat $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param int $contactId
     * @param array $with
     * @return Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getByUserAndContact(int $userId, int $contactId, array $with = [])
    {
        return $this->model
            ->with($with)
            ->where(function (Builder $query) use ($userId, $contactId) {
                $query->where('primary_user_id', $userId)
                    ->orWhere('primary_user_id', $contactId);
            })
            ->where(function (Builder $query) use ($userId, $contactId) {
                $query->where('secondary_user_id', $userId)
                    ->orWhere('secondary_user_id', $contactId);
            })->first();
    }

    public function createChat(ChatDTO $chatDTO): Model
    {
        $chat = new Chat();
        $chat->primaryUser()->associate($chatDTO->primaryUser);
        $chat->primaryUser()->associate($chatDTO->secondaryUser);
        $chat->save();
        return $chat;
    }
}
