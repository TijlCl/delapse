<?php
namespace App\Http\Actions;


use App\Events\NewFriendRequestEvent;
use App\Events\NewHelpRequestEvent;
use App\Http\DTO\FriendDTO;
use App\Http\Repositories\FriendRepository;
use App\Http\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RequestHelpAction
{

    private FriendRepository $friendRepository;
    private UserRepository $userRepository;

    public function __construct(FriendRepository $friendRepository, UserRepository $userRepository)
    {
        $this->friendRepository = $friendRepository;
        $this->userRepository = $userRepository;
    }


    public function execute()
    {
        $users = $this->userRepository->getHelpUsers(Auth::id());
        $users->each(function (User $user){
            $friendDTO = new FriendDTO($user->id, Auth::id());
            event(new NewHelpRequestEvent(Auth::User(), $user->id));
            return $this->friendRepository->request($friendDTO, true);
        });
    }
}
