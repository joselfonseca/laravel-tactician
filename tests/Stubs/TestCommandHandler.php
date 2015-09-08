<?php

namespace Joselfonseca\LaravelTactician\Tests\Stubs;


class TestCommandHandler {

    public function handle($command)
    {
        return $command;
    }

}