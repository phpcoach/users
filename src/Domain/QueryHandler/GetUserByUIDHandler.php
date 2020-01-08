<?php

namespace Domain\QueryHandler;

use Domain\Query\GetUserByUID;
use Domain\Exception\UserNotFoundException;
use Domain\Model\User;
use Domain\Model\UserRepository;

/**
 * Class GetUserByUIDHandler
 */
final class GetUserByUIDHandler
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
     * @param GetUserByUID $getUserByUID
     *
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function handle(GetUserByUID $getUserByUID) : User
    {
        return $this
            ->userRepository
            ->getByUID($getUserByUID->getUserUID());
    }
}