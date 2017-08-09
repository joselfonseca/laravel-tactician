<?php

namespace Joselfonseca\LaravelTactician\Locator;

use League\Tactician\Exception\MissingHandlerException;

class LaravelLazyLocator extends LaravelLocator
{

    /**
     * Bind a handler instance to receive all commands with a certain class
     *
     * @param string $handler          Handler to receive class name
     * @param string $commandClassName Command class e.g. "My\TaskAddedCommand"
     */
    public function addHandler($handler, $commandClassName)
    {
        $this->handlers[$commandClassName] = function () use ($handler) {
            return app($handler);
        };
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
        if (!is_callable($this->handlers[$commandName])) {
            throw MissingHandlerException::forCommand($commandName);
        }

        /** @var callable $handler */
        $handler = $this->handlers[$commandName];

        return $handler();
    }
}
