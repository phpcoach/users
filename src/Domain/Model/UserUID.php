<?php

namespace Domain\Model;

/**
 * Class UserUID
 */
final class UserUID
{
    /**
     * @var string
     */
    private $id;

    /**
     * UserUID constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Compose UID
     *
     * @return string
     */
    public function compose() : string
    {
        return $this->getId();
    }
}