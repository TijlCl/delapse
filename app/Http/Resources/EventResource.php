<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'title' => $this->title,
            'date' => Carbon::parse($this->date)->format('D d-m-Y'),
            'description' => $this->description,
            'image' => $this->image->name,
            'tag' => $this->tag,
        ];
    }
}
