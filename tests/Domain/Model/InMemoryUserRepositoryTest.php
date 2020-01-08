<?php

namespace Domain\Tests\Model;

use Domain\Model\InMemoryUserRepository;
use Domain\Model\UserRepository;

/**
 * Class InMemoryUserRepositoryTest
 */
class InMemoryUserRepositoryTest extends UserRepositoryTest
{
    /**
     * @inheritDoc
     */
    public function getEmptyUserRepository(): UserRepository
    {
        return new InMemoryUserRepository();
    }
}