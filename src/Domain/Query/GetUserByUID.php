<?php

namespace Domain\Query;

use Domain\Model\UserUID;

/**
 * Class GetUserByUID
 */
final class GetUserByUID
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