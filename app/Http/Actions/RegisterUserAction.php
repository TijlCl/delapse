<?php
namespace App\Http\Actions;

use App\Http\DTO\RegisterUserDTO;
use App\Http\Repositories\UserRepository;
use App\Models\Setting;

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
        $user = $this->userRepository->create($registerUserDTO->toArray());

        $user->setting()->save(new Setting);
    }
}
