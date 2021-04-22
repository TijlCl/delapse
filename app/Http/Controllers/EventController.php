<?php

namespace App\Http\Controllers;

use App\Http\DTO\EventDTO;
use App\Http\Repositories\EventRepository;
use App\Http\Repositories\ImageRepository;
use App\Http\Requests\EventRequest;
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
        // middleware
        $this->middleware('event_ownership')->only(['show', 'update']);

        // repositories
        $this->eventRepository = $eventRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $events = $this->eventRepository->getEventsOfUser(Auth::id(), ['image']);
        return EventResource::collection($events);
    }

    /**
     * @param Request $request
     * @param int $eventId
     * @return EventResource
     */
    public function show(Request $request, int $eventId)
    {
        $event = $this->eventRepository->find($eventId, ['image']);
        return new EventResource($event);
    }

    /**
     * @param EventRequest $request
     * @return EventResource
     */
    public function store(EventRequest $request)
    {
        // get random image for the new event
        $image = $this->imageRepository->getRandom();
        $eventDTO = new EventDTO($request->all() + ['imageId' => $image['id']]);
        $event = $this->eventRepository->createEvent($eventDTO);
        return new EventResource($event);
    }

    public function update(EventRequest $request, int $eventId)
    {
        $eventDTO = new EventDTO($request->all() + ['id' => $eventId]);
        $event = $this->eventRepository->updateEvent($eventDTO);
        return new EventResource($event);
    }

    public function destroy()
    {

    }

}
