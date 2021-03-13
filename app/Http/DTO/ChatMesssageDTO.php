<?php

namespace App\Http\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class ChatMesssageDTO extends DataTransferObject
{
    public int $from;
    public int $to;
    public int $chatId;
    public string $body;
    public Carbon $sendAt;


    /**
     * @param array $data
     */
    public function __construct(int $to, array $data)
    {
        $this->from = Auth::id();
        $this->to = $to;
        $this->chatId = $data['chatId'];
        $this->body = $data['message'];
        $this->sendAt = Carbon::now();
    }
}
