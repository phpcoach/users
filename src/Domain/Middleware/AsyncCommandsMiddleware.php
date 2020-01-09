<?php

namespace Domain\Middleware;

use Domain\Async\AsyncAdapter;
use League\Tactician\Middleware;

/**
 * Class AsyncCommandsMiddleware
 */
class AsyncCommandsMiddleware implements Middleware
{
    /**
     * @var AsyncAdapter
     */
    private $asyncAdapter;

    /**
     * AsyncCommandsMiddleware constructor.
     *
     * @param AsyncAdapter $asyncAdapter
     */
    public function __construct(AsyncAdapter $asyncAdapter)
    {
        $this->asyncAdapter = $asyncAdapter;
    }

    /**
     * @inheritDoc
     */
    public function execute($command, callable $next)
    {
        $this
            ->asyncAdapter
            ->enqueueCommand($command);

        return;
    }
}