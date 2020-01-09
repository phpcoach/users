<?php

namespace Domain\Middleware;

use League\Tactician\Middleware;

/**
 * Class ReturnVoidMiddleware
 */
class ReturnVoidMiddleware implements Middleware
{
    /**
     * @inheritDoc
     */
    public function execute($command, callable $next)
    {
        $next($command);
    }
}