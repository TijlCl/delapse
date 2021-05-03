<?php

namespace App\Http\Controllers;


use App\Http\Actions\RequestFriendAction;
use App\Http\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    private UserRepository $userRepository;
    private RequestFriendAction $requestFriendAction;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, RequestFriendAction $requestFriendAction)
    {
        $this->userRepository = $userRepository;
        $this->requestFriendAction = $requestFriendAction;
    }

    public function show(Request $request, int $userId)
    {
        $user = $this->userRepository->find($userId);
        return new UserResource($user) ;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getByUsername(Request $request)
    {
        $users = $this->userRepository->getByUsername($request->get('username'));
        return UserResource::collection($users) ;
    }


    public function friendRequest(Request $request, int $friendId)
    {
        $this->requestFriendAction->execute($friendId);
        return new JsonResource(['message' => 'success']);
    }



}
