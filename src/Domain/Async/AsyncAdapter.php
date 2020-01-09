<?php

namespace Domain\Async;

/**
 * Interface AsyncAdapter
 */
interface AsyncAdapter
{
    /**
     * Create queue
     */
    public function createQueue() : void;

    /**
     * Enqueue command
     *
     * @param object $command
     *
     * @return void
     */
    public function enqueueCommand($command) : void;

    /**
     * Consume command
     *
     * @param Callback $callback
     */
    public function consumeCommand($callback);
}