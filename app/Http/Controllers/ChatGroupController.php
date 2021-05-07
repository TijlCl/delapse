<?php

namespace App\Http\Controllers;

use App\Http\Actions\AddMessageToGroupChatAction;
use App\Http\DTO\GroupChatMesssageDTO;
use App\Http\Repositories\ChatGroupRepository;
use App\Http\Resources\ChatGroupResource;
use App\Http\Resources\ChatResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatGroupController extends Controller
{

    private ChatGroupRepository $chatGroupRepository;
    private AddMessageToGroupChatAction $addMessageToGroupChatAction;


    public function __construct(ChatGroupRepository $chatGroupRepository, AddMessageToGroupChatAction $addMessageToGroupChatAction)
    {
        $this->chatGroupRepository = $chatGroupRepository;
        $this->addMessageToGroupChatAction = $addMessageToGroupChatAction;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $chatGroups = $this->chatGroupRepository->getByUser(Auth::id(), ['users']);
        return ChatGroupResource::collection($chatGroups);
    }

    /**
     * @param Request $request
     * @return ChatGroupResource
     */
    public function show(Request $request, int $chat)
    {
        $chatGroup = $this->chatGroupRepository->find($chat, ['messages', 'users']);
        return new ChatGroupResource($chatGroup);
    }

    /**
     * @param Request $request
     * @return ChatGroupResource
     */
    public function store(Request $request)
    {
        $chatGroup = $this->chatGroupRepository->createChatGroup(Auth::id(), $request->input('friends'));
        return new ChatGroupResource($chatGroup);
    }


    /**
     * @param Request $request
     * @param int $chatId
     */
    public function sendMessage(Request $request, int $chatId)
    {
        $chatMessageDTO = new GroupChatMesssageDTO($chatId, $request->all());
        $this->addMessageToGroupChatAction->execute($chatMessageDTO);
    }

    public function addUser(Request $request, int $chatId)
    {
        $this->chatGroupRepository->addUser($chatId, $request->input('friendId'));
    }
}
