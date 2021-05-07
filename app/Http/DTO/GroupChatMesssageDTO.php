<?php

namespace App\Http\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class GroupChatMesssageDTO extends DataTransferObject
{
    public int $user;
    public int $groupChatId;
    public string $body;
    public Carbon $sendAt;


    /**
     * @param array $data
     */
    public function __construct(int $chatId, array $data)
    {
        $this->user = Auth::id();
        $this->groupChatId = $chatId;
        $this->body = $data['message'];
        $this->sendAt = Carbon::now();
    }
}
