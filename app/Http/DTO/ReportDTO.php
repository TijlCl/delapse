<?php

namespace App\Http\DTO;

use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class ReportDTO extends DataTransferObject
{
    public ?int $id;
    public int $reporter;
    public int $userId;
    public string $reason;
    public string $description;


    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->reporter = Auth::id();
        $this->userId = $data['user_id'];
        $this->reason = $data['reason'];
        $this->description = $data['description'];
    }
}
