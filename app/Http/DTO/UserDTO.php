<?php

namespace App\Http\DTO;

use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public int $id;
    public string $name;
    public ?string $phoneNumber;
    public ?string $image;


    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = Auth::id();
        $this->name = $data['name'];
        $this->phoneNumber = $data['phone_number'] ?? null;
        $this->image = $data['image'] ?? null;
    }
}
