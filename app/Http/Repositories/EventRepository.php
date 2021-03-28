<?php

namespace App\Http\Repositories;

use App\Http\DTO\EventDTO;
use App\Models\Event;

class EventRepository extends BaseRepository
{

    /**
     * @param Event $model
     */
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getEventsOfUser(int $userId, array $with = ['image'])
    {
        return Event::with($with)->where('user_id', $userId)->get();
    }

    /**
     * @param EventDTO $DTO
     * @return Event
     */
    public function createEvent(EventDTO $DTO): Event
    {
        $event = new Event([
            'title' => $DTO->title,
            'description' => $DTO->description,
            'date' => $DTO->date,
            'tag' => $DTO->tag,
        ]);
        $event->user()->associate($DTO->userId);
        $event->image()->associate($DTO->imageId);
        $event->save();
        return $event;
    }
}
