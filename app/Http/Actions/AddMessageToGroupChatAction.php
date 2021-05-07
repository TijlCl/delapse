<?php
namespace App\Http\Actions;

use App\Events\NewGroupMessageEvent;
use App\Events\NewMessageEvent;
use App\Http\DTO\ChatMesssageDTO;
use App\Http\DTO\GroupChatMesssageDTO;
use App\Http\DTO\RegisterUserDTO;
use App\Http\Repositories\ChatRepository;
use App\Http\Repositories\GroupMessageRepository;
use App\Http\Repositories\MessageRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class AddMessageToGroupChatAction
{
    /**
     * @var GroupMessageRepository
     */
    private $groupMessageRepository;

    /**
     * @param GroupMessageRepository $groupMessageRepository
     */
    public function __construct(GroupMessageRepository $groupMessageRepository)
    {
        $this->groupMessageRepository = $groupMessageRepository;
    }

    /**
     * @param GroupChatMesssageDTO $groupChatMesssageDTO
     */
    public function execute(GroupChatMesssageDTO $groupChatMesssageDTO)
    {
        $message = $this->groupMessageRepository->createNewMessage($groupChatMesssageDTO);
        event(new NewGroupMessageEvent($groupChatMesssageDTO, $groupChatMesssageDTO->groupChatId, Auth::id()));
    }
}
