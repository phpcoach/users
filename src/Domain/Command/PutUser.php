<?php

namespace Domain\Command;

use Domain\Model\User;

/**
 * Class PutUser
 */
final class PutUser
{
    /**
     * @var User
     */
    private $user;

    /**
     * PutUser constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}