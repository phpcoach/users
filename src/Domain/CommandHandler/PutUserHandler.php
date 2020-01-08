<?php

namespace Domain\CommandHandler;

use Domain\Command\PutUser;
use Domain\Model\UserRepository;

/**
 * Class PutUserHandler
 */
final class PutUserHandler
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
     * @param PutUser $putUser
     */
    public function handle(PutUser $putUser) : void
    {
        $this
            ->userRepository
            ->put($putUser->getUser());
    }
}