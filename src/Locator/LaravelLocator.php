<?php

namespace Joselfonseca\LaravelTactician\Locator;

use League\Tactician\Handler\Locator\HandlerLocator;
use League\Tactician\Exception\MissingHandlerException;

class LaravelLocator implements HandlerLocator{

    /**
     * Bind a handler instance to receive all commands with a certain class
     *
     * @param string $handler Handler to receive class name
     * @param string $commandClassName Command class e.g. "My\TaskAddedCommand"
     */
    public function addHandler($handler, $commandClassName)
    {
        $handlerInstance = app($handler);
        $this->handlers[$commandClassName] = $handlerInstance;
    }

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
    protected function addHandlers(array $commandClassToHandlerMap)
    {
        foreach ($commandClassToHandlerMap as $commandClass => $handler) {
            $this->addHandler($handler, $commandClass);
        }
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     *
     * @return object
     *
     * @throws MissingHandlerException
     */
    public function getHandlerForCommand($commandName)
    {
        if (!isset($this->handlers[$commandName])) {
            throw MissingHandlerException::forCommand($commandName);
        }

        return $this->handlers[$commandName];
    }

}