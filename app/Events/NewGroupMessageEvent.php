<?php

namespace App\Events;

use App\Http\DTO\ChatMesssageDTO;
use App\Http\DTO\GroupChatMesssageDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NewGroupMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $chatId;
    private $senderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GroupChatMesssageDTO $groupChatMesssageDTO, int $chatId, int $senderId)
    {
        $this->message = $groupChatMesssageDTO;
        $this->chatId = $chatId;
        $this->senderId = $senderId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('group-message.' . $this->chatId);
    }

    public function broadcastWith()
    {
        return [
            'message' => [
                'body'            => $this->message->body,
                'senderId'        => $this->senderId
            ]
        ];
    }

    public function broadcastAs() {
        return 'new-group-message';
    }
}
