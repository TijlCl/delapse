<?php

namespace App\Http\Repositories;

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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getEventsOfUser(int $userId)
    {
        return Event::where('user_id', $userId)
            ->get();
    }
}
