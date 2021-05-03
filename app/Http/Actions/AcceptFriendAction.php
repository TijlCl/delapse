<?php
namespace App\Http\Actions;


use App\Http\DTO\ChatDTO;
use App\Http\DTO\FriendDTO;
use App\Http\Repositories\ChatRepository;
use App\Http\Repositories\FriendRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use const http\Client\Curl\AUTH_ANY;

class AcceptFriendAction
{

    private FriendRepository $friendRepository;
    private ChatRepository $chatRepository;

    public function __construct(FriendRepository $friendRepository, ChatRepository $chatRepository)
    {
        $this->friendRepository = $friendRepository;
        $this->chatRepository = $chatRepository;
    }

    /**
     * @param int $friendId
     * @return \App\Models\Friend
     */
    public function execute(int $friendId)
    {
        DB::transaction(function ($friendId) {
            //create chat record
            $chatDTO = new ChatDTO(Auth::id(), $friendId);
            $chat = $this->chatRepository->createChat($chatDTO);

            //Get the friend record
            $friend = $this->friendRepository->findByFriendAndUser($friendId, Auth::id());
            //create accept friend
            $this->friendRepository->acceptRequest($friend, $chat->id);
            //Make the inverse record
            $friendDTO = new FriendDTO($friendId, Auth::id(), $chat->id);
            $this->friendRepository->createInverse($friendDTO);
        });
    }
}
