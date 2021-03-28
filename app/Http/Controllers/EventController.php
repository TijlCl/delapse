<?php

namespace App\Http\Controllers;

use App\Http\DTO\EventDTO;
use App\Http\Repositories\EventRepository;
use App\Http\Repositories\ImageRepository;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    private EventRepository $eventRepository;
    private ImageRepository $imageRepository;

    /**
     * EventController constructor.
     * @param EventRepository $eventRepository
     * @param ImageRepository $imageRepository
     */
    public function __construct(EventRepository $eventRepository, ImageRepository $imageRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->imageRepository = $imageRepository;
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
        // get random image for the new event
        $image = $this->imageRepository->getRandom();
        $eventDTO = new EventDTO($request->all() + ['imageId' => $image['id']]);
        $event = $this->eventRepository->createEvent($eventDTO);
        return new EventResource($event);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}
