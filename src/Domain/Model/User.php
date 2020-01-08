<?php
namespace Domain\Model;

/**
 * Class User
 */
final class User
{
    /**
     * @var UserUID
     */
    private $userUID;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;

    /**
     * User constructor.
     *
     * @param UserUID $userUID
     * @param string $name
     * @param int $age
     */
    public function __construct(
        UserUID $userUID,
        string $name,
        int $age
    )
    {
        $this->userUID = $userUID;
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * Get UID
     *
     * @return UserUID
     */
    public function getUID(): UserUID
    {
        return $this->userUID;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }
}