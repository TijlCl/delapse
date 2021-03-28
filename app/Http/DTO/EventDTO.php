<?php

namespace App\Http\DTO;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class EventDTO extends DataTransferObject
{
    public string $title;
    public string $description;
    public ?int $id;
    public int $userId;
    public int $imageId;
    public Carbon $date;
    public string $tag;



    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->id = $data['id'] ?? null;
        $this->userId = Auth::id();
        $this->imageId = $data['imageId'];
        $this->date = Carbon::createFromDate($data['date']);
        $this->tag = $data['tag'];
    }
}
