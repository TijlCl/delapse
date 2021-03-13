<?php

namespace App\Http\Controllers;

use App\Http\Repositories\FriendRepository;
use App\Http\Resources\FriendResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    private FriendRepository $friendRepository;

    /**
     * FriendsController constructor.
     * @param FriendRepository $friendRepository
     */
    public function __construct(FriendRepository $friendRepository)
    {
        $this->friendRepository = $friendRepository;
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
}
