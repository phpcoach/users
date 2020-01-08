<?php

namespace Domain\Tests\Model;

use Domain\Exception\UserNotFoundException;
use Domain\Model\User;
use Domain\Model\UserRepository;
use Domain\Model\UserUID;
use PHPUnit\Framework\TestCase;

/**
 * Class UserRepositoryTest
 */
abstract class UserRepositoryTest extends TestCase
{
    /**
     * Get empty user repository
     *
     * @return UserRepository
     */
    abstract public function getEmptyUserRepository() : UserRepository;


    /**
     * Test exception when empty
     */
    public function testExceptionWhenEmpty()
    {
        $repository = $this->getEmptyUserRepository();
        $this->expectException(UserNotFoundException::class);
        $repository->getByUID(new UserUID('1'));
    }

    /**
     * Test exception when not found
     */
    public function testExceptionWhenNotFound()
    {
        $repository = $this->getEmptyUserRepository();
        $repository->put(new User(new UserUID('0'), 'marc', 34));
        $this->expectException(UserNotFoundException::class);
        $repository->getByUID(new UserUID('1'));
    }

    /**
     * Test found
     */
    public function testFound()
    {
        $repository = $this->getEmptyUserRepository();
        $repository->put(new User(new UserUID('1'), 'marc', 34));
        $user = $repository->getByUID(new UserUID('1'));
        $this->assertEquals('1', $user->getUID()->getId());
        $this->assertEquals('marc', $user->getName());
        $this->assertEquals(34, $user->getAge());
    }

    /**
     * Test is changed
     */
    public function testIsChanged()
    {
        $repository = $this->getEmptyUserRepository();
        $repository->put(new User(new UserUID('1'), 'marc', 34));
        $repository->put(new User(new UserUID('1'), 'àlex', 35));
        $user = $repository->getByUID(new UserUID('1'));
        $this->assertEquals('1', $user->getUID()->getId());
        $this->assertEquals('àlex', $user->getName());
        $this->assertEquals(35, $user->getAge());
    }

    /**
     * Test is deleted when exists
     */
    public function testIsDeletedWhenExists()
    {
        $repository = $this->getEmptyUserRepository();
        $repository->put(new User(new UserUID('1'), 'marc', 34));
        $repository->delete(new UserUID('1'));
        $this->expectException(UserNotFoundException::class);
        $repository->getByUID(new UserUID('1'));
    }

    /**
     * Test is deleted when missing
     */
    public function testIsDeletedWhenMissing()
    {
        $repository = $this->getEmptyUserRepository();
        $this->expectException(UserNotFoundException::class);
        $repository->delete(new UserUID('1'));
    }
}