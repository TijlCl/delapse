<?php

namespace App\Http\Controllers;

use App\Http\Actions\AcceptFriendAction;
use App\Http\Repositories\FriendRepository;
use App\Http\Resources\FriendRequestResource;
use App\Http\Resources\FriendResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    private FriendRepository $friendRepository;
    private AcceptFriendAction $acceptFriendAction;

    /**
     * FriendsController constructor.
     * @param FriendRepository $friendRepository
     */
    public function __construct(FriendRepository $friendRepository, AcceptFriendAction $acceptFriendAction)
    {
        $this->friendRepository = $friendRepository;
        $this->acceptFriendAction = $acceptFriendAction;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $friends = $this->friendRepository->getFriendsOfUser(Auth::id());
        return FriendResource::collection($friends);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function requests(Request $request)
    {
        $friends = $this->friendRepository->getFriendRequestsOfUser(Auth::id());
        return FriendRequestResource::collection($friends);
    }

    /**
     * @param Request $request
     * @param int $friendId
     * @return FriendResource
     */
    public function accept(Request $request, int $friendId)
    {
        $friend = $this->acceptFriendAction->execute($friendId);
        return new FriendResource($friend);
    }
}
