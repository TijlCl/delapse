<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'completed_at' => $this->completed_at == null ? $this->completed_at : Carbon::make($this->completed_at)->format('d/m/Y'),
            'description' => $this->description,
            'image' => $this->image == null ? $this->image : Storage::disk('public')->url($this->image ?? null),
            'invalid_at' => $this->invalid_at,
            'challenge' => new ChallengeResource($this->challenge),
        ];
    }
}
