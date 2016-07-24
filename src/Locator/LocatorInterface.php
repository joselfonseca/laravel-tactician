<?php

namespace Joselfonseca\LaravelTactician\Locator;

use League\Tactician\Handler\Locator\HandlerLocator;

/**
 * Interface LocatorInterface
 * @package Joselfonseca\LaravelTactician\Locator
 */
interface LocatorInterface extends HandlerLocator
{
    /**
     * Bind a handler instance to receive all commands with a certain class
     *
     * @param string $handler          Handler to receive class name
     * @param string $commandClassName Command class e.g. "My\TaskAddedCommand"
     */
    public function addHandler($handler, $commandClassName);

    /**
     * Allows you to add multiple handlers at once.
     *
     * The map should be an array in the format of:
     *  [
     *      AddTaskCommand::class      => $someHandlerClassName,
     *      CompleteTaskCommand::class => $someHandlerClassName,
     *  ]
     *
     * @param array $commandClassToHandlerMap
     */
    public function addHandlers(array $commandClassToHandlerMap);
}
