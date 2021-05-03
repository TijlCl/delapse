<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'body' => $this->body,
            'from' => $this->from_id,
            'to' => $this->to_id,
            'isSender' => Auth::id() === $this->from_id,
            'isUnread' => $this->isUnread
        ];
    }
}
