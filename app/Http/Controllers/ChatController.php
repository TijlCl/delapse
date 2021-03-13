<?php

namespace App\Http\Controllers;

use App\Http\Actions\AddMessageToChatAction;
use App\Http\Actions\RegisterUserAction;
use App\Http\DTO\ChatMesssageDTO;
use App\Http\DTO\RegisterUserDTO;
use App\Http\Repositories\ChatRepository;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ChatResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChatController extends Controller
{

    private ChatRepository $chatRepository;
    private AddMessageToChatAction $addMessageToChatAction;

    /**
     * ChatController constructor.
     * @param ChatRepository $chatRepository
     * @param AddMessageToChatAction $addMessageToChatAction
     */
    public function __construct(ChatRepository $chatRepository, AddMessageToChatAction $addMessageToChatAction)
    {
        $this->chatRepository = $chatRepository;
        $this->addMessageToChatAction = $addMessageToChatAction;
    }

    /**
     * @param Request $request
     * @return ChatResource
     */
    public function show(Request $request, int $chat)
    {
        $chat = $this->chatRepository->getByUserAndContact(Auth::id(), $chat, ['messages']);
        return new ChatResource($chat);
    }

    /**
     * @param Request $request
     */
    public function sendMessage(Request $request, int $chat)
    {
        $chatMessageDTO = new ChatMesssageDTO($chat, $request->all());
        $this->addMessageToChatAction->execute($chatMessageDTO);
    }
}
