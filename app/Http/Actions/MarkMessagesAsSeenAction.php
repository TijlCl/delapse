<?php
namespace App\Http\Actions;

use App\Events\NewMessageEvent;
use App\Http\DTO\ChatMesssageDTO;
use App\Http\DTO\RegisterUserDTO;
use App\Http\Repositories\ChatRepository;
use App\Http\Repositories\MessageRepository;
use App\Http\Repositories\UserRepository;

class MarkMessagesAsSeenAction
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param ChatMesssageDTO $chatMesssageDTO
     */
    public function execute(int $fromId)
    {
        $this->messageRepository->markAsReadByUser($fromId);
    }
}
