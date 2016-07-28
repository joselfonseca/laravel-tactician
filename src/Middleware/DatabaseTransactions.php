<?php

namespace Joselfonseca\LaravelTactician\Middleware;

use DB;
use League\Tactician\Middleware;

/**
 * Run the command in a database transaction.
 * @package Joselfonseca\LaravelTactician\Middleware
 */
class DatabaseTransactions implements Middleware
{

    /**
     * @param object $command
     * @param callable $next
     * @return null
     */
    public function execute($command, callable $next)
    {
        $pipeline = null;
        DB::transaction(function () use ($next, $command, &$pipeline) {
            $pipeline = $next($command);
        });
        return $pipeline;
    }
}
