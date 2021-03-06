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
            'enableLocation' => boolval($this->enable_location),
            'sponsor' => boolval($this->sponsor),
            'publicGallery' => boolval($this->public_gallery),
            'emergencyContact' => boolval($this->emergency_contact),
        ];
    }
}
