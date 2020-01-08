<?php

namespace Domain\Model;

use Domain\Exception\UserNotFoundException;

/**
 * Interface UserRepository
 */
interface UserRepository
{
    /**
     * Put user
     *
     * @param User $user
     *
     * @return void
     */
    public function put(User $user) : void;

    /**
     * Get user by UID
     *
     * @param UserUID $userUUID
     *
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function getByUID(UserUID $userUUID) : User;

    /**
     * Delete user
     *
     * @param UserUID $userUid
     *
     * @return void
     *
     * @throws UserNotFoundException
     */
    public function delete(UserUID $userUid) : void;
}