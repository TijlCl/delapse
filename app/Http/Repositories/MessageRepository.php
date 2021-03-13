<?php

namespace App\Http\Repositories;

use App\Http\DTO\ChatMesssageDTO;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MessageRepository extends BaseRepository
{

    /**
     * @param Chat $model
     */
    public function __construct(Chat $model)
    {
        parent::__construct($model);
    }

    /**
     * @param ChatMesssageDTO $chatMesssageDTO
     */
    public function createNewMessage(ChatMesssageDTO $chatMesssageDTO)
    {
        $message = new Message([
            'body' => $chatMesssageDTO->body,
            'send_at' => $chatMesssageDTO->sendAt
        ]);
        $message->from()->associate($chatMesssageDTO->from);
        $message->to()->associate($chatMesssageDTO->to);
        $message->chat()->associate($chatMesssageDTO->chatId);
        $message->save();
    }
}
