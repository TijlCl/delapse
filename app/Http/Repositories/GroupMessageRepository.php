<?php

namespace App\Http\Repositories;

use App\Http\DTO\ChatMesssageDTO;
use App\Http\DTO\GroupChatMesssageDTO;
use App\Models\Chat;
use App\Models\GroupMessage;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GroupMessageRepository extends BaseRepository
{

    /**
     * @param GroupMessage $model
     */
    public function __construct(GroupMessage $model)
    {
        parent::__construct($model);
    }

    /**
     * @param GroupChatMesssageDTO $groupChatMesssageDTO
     * @return GroupMessage
     */
    public function createNewMessage(GroupChatMesssageDTO $groupChatMesssageDTO)
    {
        $message = new GroupMessage([
            'body' => $groupChatMesssageDTO->body,
            'send_at' => $groupChatMesssageDTO->sendAt
        ]);
        $message->user()->associate($groupChatMesssageDTO->user);
        $message->chatGroup()->associate($groupChatMesssageDTO->groupChatId);
        $message->save();
        return $message;
    }
}
