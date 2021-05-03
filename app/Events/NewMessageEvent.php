<?php

namespace App\Events;

use App\Http\DTO\ChatMesssageDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $messageId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatMesssageDTO $chatMesssageDTO, int $messageId)
    {
        $this->message = $chatMesssageDTO;
        $this->messageId = $messageId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('message.' . $this->message->to);
    }

    public function broadcastWith()
    {
        return [
            'message' => [
                'id'            => $this->messageId,
                'body'            => $this->message->body,
            ]
        ];
    }

    public function broadcastAs() {
        return 'new-message';
    }
}
