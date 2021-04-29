<?php

namespace App\Http\Controllers;


use App\Http\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserRepository $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

}
