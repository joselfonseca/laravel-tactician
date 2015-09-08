<?php

namespace Joselfonseca\LaravelTactician\Tests\Locator;

use Joselfonseca\LaravelTactician\Tests\TestCase;

/**
 * Class TestLaravelLocator
 * @package Joselfonseca\LaravelTactician\Tests\Locator
 */
class TestLaravelLocator extends TestCase{

    /**
     * It resolves the locator
     */
    public function test_it_resolves_the_laravel_locator()
    {
        $this->assertInstanceOf('League\Tactician\Handler\Locator\HandlerLocator',
            app('Joselfonseca\LaravelTactician\Locator\LaravelLocator'));
    }

    /**
     * Throws exception if no handler for a command has been added
     * @expectedException League\Tactician\Exception\MissingHandlerException
     */
    public function test_it_throws_exception_when_locator_from_laravel_container_is_not_found()
    {
        $locator = app('League\Tactician\Handler\Locator\HandlerLocator');
        $handler = $locator->getHandlerForCommand('TestCommand');
    }

    /**
     * Throws exception if laravel container can't resolve the handler class
     * @expectedException ReflectionException
     */
    public function test_it_throws_exception_when_locator_is_not_resolve_from_laravel_container()
    {
        $locator = app('League\Tactician\Handler\Locator\HandlerLocator');
        $locator->addHandler('SomeCommandHandler',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand');
    }

    /**
     * It is able to resolve the locator from the container
     */
    public function test_it_is_able_to_resolve_handler_from_laravel_container()
    {
        $locator = app('League\Tactician\Handler\Locator\HandlerLocator');
        $locator->addHandler('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler',
            'Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand');
        $handler = $locator->getHandlerForCommand('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommand');
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Tests\Stubs\TestCommandHandler', $handler);
    }

}