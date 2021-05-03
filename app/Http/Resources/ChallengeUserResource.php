<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'image' => $this->image == null ? $this->image : Storage::disk('public')->url($this->image ?? null),
            'challenge' => new ChallengeResource($this->challenge),
        ];
    }
}
