<?php

namespace Domain\Command;

use Domain\Model\UserUID;

/**
 * Class DeleteUser
 */
final class DeleteUser
{
    /**
     * @var UserUID
     */
    private $userUID;

    /**
     * PutUser constructor.
     *
     * @param UserUID $userUID
     */
    public function __construct(UserUID $userUID)
    {
        $this->userUID = $userUID;
    }

    /**
     * @return UserUID
     */
    public function getUserUID(): UserUID
    {
        return $this->userUID;
    }
}