<?php

namespace Domain\CommandHandler;

use Domain\Command\DeleteUser;
use Domain\Model\UserRepository;

/**
 * Class DeleteUserHandler
 */
final class DeleteUserHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * DeleteUserHandler constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle
     *
     * @param DeleteUser $deleteUser
     */
    public function handle(DeleteUser $deleteUser) : void
    {
        $this
            ->userRepository
            ->delete($deleteUser->getUserUID());
    }
}