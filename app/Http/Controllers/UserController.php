<?php

namespace App\Http\Controllers;


use App\Http\Actions\RequestFriendAction;
use App\Http\Actions\StoreFileAction;
use App\Http\DTO\UserDTO;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\ChangeProfilePictureRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    private UserRepository $userRepository;
    private RequestFriendAction $requestFriendAction;
    private StoreFileAction $storeFileAction;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param RequestFriendAction $requestFriendAction
     * @param StoreFileAction $storeFileAction
     */
    public function __construct(UserRepository $userRepository,
                                RequestFriendAction $requestFriendAction,
                                StoreFileAction $storeFileAction)
    {
        $this->userRepository = $userRepository;
        $this->requestFriendAction = $requestFriendAction;
        $this->storeFileAction = $storeFileAction;
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

    /**
     * @param ChangeProfilePictureRequest $request
     * @return string
     */
    public function changeProfilePicture(ChangeProfilePictureRequest $request)
    {
        $imagePath = $this->storeFileAction->execute($request->file('image'), 'profile_pictures/');

        $this->userRepository->updateProfilePicture(Auth::id(), $imagePath);

        return Storage::disk('public')->url($imagePath);
    }

    /**
     * @param UpdateUserRequest $request
     */
    public function update(UpdateUserRequest $request)
    {
        // store new profile picture
        if ($request->hasFile('image')) {
            $imagePath = $this->storeFileAction->execute($request->file('image'), 'profile_pictures/');
        }

        // update user
        $userDTO = new UserDTO($request->all() + ['image' => $imagePath ?? null]);
        $user = $this->userRepository->update($userDTO);

        return new UserResource($user);
    }

}
