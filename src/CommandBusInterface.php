<?php

namespace Joselfonseca\LaravelTactician;

/**
 * The default Command bus Using Tactician, this is an implementation to dispatch commands to their handlers trough a middleware stack, every class is resolved from the laravel's service container.
 * @package Joselfonseca\LaravelTactician
 */
interface CommandBusInterface
{
    /**
     * Dispatch a command
     * @param object $command    Command to be dispatched
     * @param array  $input      Array of input to map to the command
     * @param array  $middleware Array of middleware class name to add to the stack, they are resolved from the laravel container they are resolved fro the laravel container
     * @return mixed
     */
    public function dispatch($command, array $input = [], array $middleware = []);

    /**
     * Add the Command Handler
     * @param string $command Class name of the command
     * @param string $handler Class name of the handler to be resolved from the Laravel Container
     * @return mixed
     */
    public function addHandler($command, $handler);
}
