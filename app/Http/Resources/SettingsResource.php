<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SettingsResource extends JsonResource
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
            'enable_location' => $this->enable_location,
            'apply_as_sponsor' => $this->apply_as_sponsor,
            'public_gallery' => $this->public_gallery,
            'emergency_contact' => $this->emergency_contact,
        ];
    }
}
