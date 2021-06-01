<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CheckInGraphResource extends JsonResource
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
            'total' => $this['total_check_ins'],
            'moods' => $this['mood_counts'],
            'checkIns' => CheckInResource::collection($this['check_ins'])
        ];
    }
}
