<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class FriendResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('friend')),
            'chat' => new ChatResource($this->whenLoaded('chat')),
            'acceptedAt' => $this->accepted_at,
        ];
    }
}
