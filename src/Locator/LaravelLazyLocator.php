<?php

namespace Joselfonseca\LaravelTactician\Locator;

use League\Tactician\Exception\MissingHandlerException;

class LaravelLazyLocator extends LaravelLocator
{
    public function addHandler($handler, $commandClassName)
    {
        $this->handlers[$commandClassName] = function () use ($handler) {
            return app($handler);
        };
    }

    public function getHandlerForCommand($commandName)
    {
        if (!isset($this->handlers[$commandName])) {
            throw MissingHandlerException::forCommand($commandName);
        }

        return $this->handlers[$commandName]();
    }
}
