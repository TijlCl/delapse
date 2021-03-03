<?php
namespace App\Http\Actions;

use App\Http\DTO\RegisterUserDTO;
use App\Http\Repositories\UserRepository;

class RegisterUserAction
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterUserDTO $registerUserDTO
     */
    public function execute(RegisterUserDTO $registerUserDTO)
    {
        $this->userRepository->create($registerUserDTO->toArray());
    }
}
