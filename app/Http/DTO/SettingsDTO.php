<?php

namespace App\Http\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SettingsDTO extends DataTransferObject
{
    public ?int $id;
    public bool $enableLocation;
    public bool $sponsor;
    public bool $publicGallery;
    public bool $emergencyContact;


    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->enableLocation = $data['enable_location'];
        $this->sponsor = $data['sponsor'];
        $this->publicGallery = $data['public_gallery'];
        $this->emergencyContact = $data['emergency_contact'];
    }
}
