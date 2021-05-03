<?php
namespace App\Http\Actions;


use App\Http\DTO\FriendDTO;
use App\Http\Repositories\FriendRepository;
use Illuminate\Support\Facades\Auth;

class RequestFriendAction
{

    private FriendRepository $friendRepository;

    public function __construct(FriendRepository $friendRepository)
    {
        $this->friendRepository = $friendRepository;
    }

    /**
     * @param int $friendId
     * @return \App\Models\Friend
     */
    public function execute(int $friendId)
    {
        //create friend record
        $friendDTO = new FriendDTO($friendId, Auth::id());
        return $this->friendRepository->request($friendDTO);
    }
}
