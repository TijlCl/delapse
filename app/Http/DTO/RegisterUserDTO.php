<?php

namespace App\Http\DTO;

use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class RegisterUserDTO extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;


    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = Hash::make($data['password']);
    }
}
