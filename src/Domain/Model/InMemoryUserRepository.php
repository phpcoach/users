<?php


namespace Domain\Model;

use Domain\Exception\UserNotFoundException;

/**
 * Class InMemoryUserRepository
 */
class InMemoryUserRepository implements UserRepository
{
    /**
     * @var User[]
     */
    private $users = [];

    /**
     * @inheritDoc
     */
    public function put(User $user) : void
    {
        $this->users[$user->getUID()->compose()] = $user;
    }

    /**
     * @inheritDoc
     */
    public function getByUID(UserUID $userUid): User
    {
        $composedUID = $userUid->compose();
        if (!array_key_exists($composedUID, $this->users)) {
            throw new UserNotFoundException();
        }

        return $this->users[$composedUID];
    }

    /**
     * @inheritDoc
     */
    public function delete(UserUID $userUid) : void
    {
        $composedUID = $userUid->compose();
        if (!array_key_exists($composedUID, $this->users)) {
            throw new UserNotFoundException();
        }

        unset($this->users[$composedUID]);
    }
}