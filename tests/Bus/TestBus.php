<?php

namespace Joselfonseca\LaravelTactician\Tests\Bus;

use Joselfonseca\LaravelTactician\Tests\TestCase;

class TestBus extends TestCase{

    public function test_it_handles_a_command()
    {
        $bus = app('Joselfonseca\LaravelTactician\Bus');
        $bus->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler');
        $this->assertEquals('Handled', $bus->dispatch('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand', [], []));
    }

}