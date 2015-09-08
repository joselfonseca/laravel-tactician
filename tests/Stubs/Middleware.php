<?php

namespace Joselfonseca\LaravelTactician\Tests\Stubs;

use League\Tactician\Middleware as TacticianMiddleware;

class Middleware implements TacticianMiddleware{

    public function execute($command, callable $next)
    {
        $command->addedPropertyInMiddleware = "Handled";
        return $next($command);
    }

}