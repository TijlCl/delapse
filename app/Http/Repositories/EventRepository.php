<?php

namespace App\Http\Repositories;

use App\Http\DTO\EventDTO;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
    public function getEventsOfUser(int $userId, array $with = [])
    {
        return Event::with($with)->where([['user_id', $userId], ['date', '>=', Carbon::now()->toDateString()]])->orderBy('date')->limit(10)->get();
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

    /**
     * @param EventDTO $DTO
     * @return Event
     */
    public function updateEvent(EventDTO $DTO): Model
    {
        $event = $this->find($DTO->id);

        $event->fill([
            'title' => $DTO->title,
            'description' => $DTO->description,
            'date' => $DTO->date,
            'tag' => $DTO->tag,
        ]);

        $event->save();
        return $event;
    }

    public function deleteEvent(int $eventId)
    {
        Event::destroy($eventId);
    }
}
