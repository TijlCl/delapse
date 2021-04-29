<?php

namespace App\Http\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class ChallengeUserDTO extends DataTransferObject
{
    public int $id;
    public ?int $userId;
    public ?int $challengeId;
    public ?string $description;
    public ?string $image;
    public ?Carbon $completedAt;
    public ?Carbon $invalidAt;



    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->userId = $data['user_id'] ?? null;
        $this->challengeId = $data['challenge_id'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->image = $data['image'] ?? null;
        $this->completedAt = Carbon::make($data['completed_at'] ?? null);
        $this->invalidAt = Carbon::make($data['invalid_at'] ?? null);
    }
}
