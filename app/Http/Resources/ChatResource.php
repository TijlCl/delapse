<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'id' => $this->id,
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'lastMessage' => new MessageResource($this->whenLoaded('lastMessage'))
        ];
    }
}
