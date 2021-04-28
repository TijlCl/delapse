<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeUserResource extends JsonResource
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
            'description' => $this->description,
            'image' => $this->image,
            'challenge' => new ChallengeResource($this->challenge),
        ];
    }
}
