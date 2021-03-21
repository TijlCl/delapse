<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EventRepository;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    private EventRepository $eventRepository;

    /**
     * EventController constructor.
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $events = $this->eventRepository->getEventsOfUser(Auth::id());
        return EventResource::collection($events);
    }


    public function store(StoreEventRequest $request)
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}
