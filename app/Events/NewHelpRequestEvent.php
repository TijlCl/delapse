<?php

namespace App\Events;

use App\Http\DTO\ChatMesssageDTO;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewHelpRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $userId;
    private $friend;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $friend, int $userId)
    {
        $this->friend = $friend;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('help-request.' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->friend
        ];
    }

    public function broadcastAs() {
        return 'new-help-request';
    }
}
