<?php

namespace Joselfonseca\LaravelTactician\Tests\Stubs;


class TestCommandArrayHandler {

    public function handle($command)
    {
        return $command->data;
    }

}