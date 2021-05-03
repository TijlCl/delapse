<?php

namespace App\Http\Controllers;

use App\Http\Actions\AddMessageToChatAction;
use App\Http\Actions\MarkMessagesAsSeenAction;
use App\Http\Actions\RegisterUserAction;
use App\Http\DTO\ChatMesssageDTO;
use App\Http\DTO\RegisterUserDTO;
use App\Http\Repositories\ChatRepository;
use App\Http\Repositories\MessageRepository;
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
    private MessageRepository $messageRepository;
    private AddMessageToChatAction $addMessageToChatAction;
    private MarkMessagesAsSeenAction $markMessagesAsSeenAction;

    /**
     * ChatController constructor.
     * @param ChatRepository $chatRepository
     * @param AddMessageToChatAction $addMessageToChatAction
     */
    public function __construct(
        ChatRepository $chatRepository,
        AddMessageToChatAction $addMessageToChatAction,
        MarkMessagesAsSeenAction $markMessagesAsSeenAction,
        MessageRepository $messageRepository)
    {
        $this->chatRepository = $chatRepository;
        $this->messageRepository = $messageRepository;
        $this->addMessageToChatAction = $addMessageToChatAction;
        $this->markMessagesAsSeenAction = $markMessagesAsSeenAction;
    }

    /**
     * @param Request $request
     * @return ChatResource
     */
    public function show(Request $request, int $chat)
    {
        $this->markMessagesAsSeenAction->execute($chat);
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

    public function markMessageAsRead(Request $request, int $messageId)
    {
        $this->messageRepository->markAsRead($messageId);
        return response()->json([
            'message' => 'read'
        ]);
    }
}
