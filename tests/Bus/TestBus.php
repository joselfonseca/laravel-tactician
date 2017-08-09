<?php

namespace Joselfonseca\LaravelTactician\Tests\Bus;

use Joselfonseca\LaravelTactician\Tests\TestCase;

/**
 * Class TestBus
 * @package Joselfonseca\LaravelTactician\Tests\Bus
 */
class TestBus extends TestCase{

    /**
     * Test if the class can handle a command
     */
    public function test_it_handles_a_command()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler');
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand', $bus->dispatch('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand', [], []));
    }


    public function test_it_accepts_prebuilt_command_objects()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler');
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand', $bus->dispatch(app('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand'), [], []));
    }

    /**
     * Test if a a middleware can be applied to the stack
     */
    public function test_it_applies_a_middleware()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler');
        $commandHandled = $bus->dispatch('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand', [], [
            'Joselfonseca\LaravelTactician\Tests\Stubs\Middleware'
        ]);
        $this->assertEquals('Handled', $commandHandled->addedPropertyInMiddleware);
    }

    /**
     * Test if the bus is able to map a property in the command
     */
    public function test_it_maps_input_to_command()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler');
        $commandHandled = $bus->dispatch('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand', [
            'property' => 'Jhon Doe'
        ], [
            'Joselfonseca\LaravelTactician\Tests\Stubs\Middleware'
        ]);
        $this->assertEquals('Jhon Doe', $commandHandled->property);
    }

    /**
     * Test the InvalidArgumentException
     * @expectedException InvalidArgumentException
     */
    public function test_it_trows_exception_if_input_can_not_be_mapped_to_the_command()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandInput',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler');
        $commandHandled = $bus->dispatch('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandInput', [

        ], [
            'Joselfonseca\LaravelTactician\Tests\Stubs\Middleware'
        ]);
    }

}