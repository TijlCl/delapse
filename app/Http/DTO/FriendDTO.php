<?php

namespace App\Http\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class FriendDTO extends DataTransferObject
{
    public int $friendId;
    public int $userId;
    public ?int $chatId;

    /**
     * FriendDTO constructor.
     * @param int $friendId
     * @param int $userId
     * @param null $chatId
     */
    public function __construct(int $friendId, int $userId, $chatId = null)
    {
        $this->friendId = $friendId;
        $this->userId = $userId;
        $this->chatId = $chatId;
    }
}
