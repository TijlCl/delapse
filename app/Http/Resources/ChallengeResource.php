<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeResource extends JsonResource
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
            'completed' => $this->getIsCompletedAttribute(),
            'title' => $this->challenge->title,
            'description' => $this->challenge->description,
            'image' => $this->challenge->image->name,
        ];
    }
}
