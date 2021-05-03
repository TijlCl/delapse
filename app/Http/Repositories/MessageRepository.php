<?php

namespace App\Http\Repositories;

use App\Http\DTO\ChatMesssageDTO;
use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
     * @return Message
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

        return $message;
    }

    /**
     * @param int $fromId
     */
    public function markAsRead(int $messageId)
    {
        $message = Message::where('id', $messageId)->first();
        $message->seen_at = Carbon::now();
        $message->save();
    }

    /**
     * @param int $fromId
     */
    public function markAsReadByUser(int $fromId)
    {
        Message::where('from_id', $fromId)
            ->where('to_id', Auth::id())
            ->whereNull('seen_at')
            ->update(['seen_at' => Carbon::now()]);
    }
}
