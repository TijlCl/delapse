<?php

namespace App\Http\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CheckInDTO extends DataTransferObject
{
    public ?int $id;
    public string $mood;
    public string $emoji;
    public ?string $description;
    public ?string $tags;


    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->mood = $data['mood'];
        $this->emoji = $data['emoji'];
        $this->description = $data['description'];
        $this->tags = implode(', ', $data['tags']);
    }
}
