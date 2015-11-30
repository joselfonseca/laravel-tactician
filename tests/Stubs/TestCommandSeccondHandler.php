<?php

namespace Joselfonseca\LaravelTactician\Tests\Stubs;


class TestCommandSeccondHandler
{
    public function handle($command)
    {
        return $command;
    }
}