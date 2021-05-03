<?php

namespace App\Http\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class ChatDTO extends DataTransferObject
{
    public int $primaryUser;
    public int $secondaryUser;

    /**
     * ChatDTO constructor.
     * @param int $primaryUser
     * @param int $secondaryUser
     */
    public function __construct(int $primaryUser, int $secondaryUser)
    {
        $this->primaryUser = $primaryUser;
        $this->secondaryUser = $secondaryUser;
    }
}
