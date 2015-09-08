<?php

namespace Joselfonseca\LaravelTactician\Tests\Providers;


use Joselfonseca\LaravelTactician\Tests\TestCase;

/**
 * Class TestProvider
 * @package Joselfonseca\LaravelTactician\Tests\Providers
 */
class TestProvider extends TestCase{

    /**
     * It loads the service Provider
     */
    public function test_it_loads_service_provider()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider',
            app()->getProvider('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider'));
    }

    /**
     * it registers a locator
     */
    public function test_it_registers_locator()
    {
        $this->assertInstanceOf('League\Tactician\Handler\Locator\HandlerLocator',
            app('League\Tactician\Handler\Locator\HandlerLocator'));
    }

    /**
     * It registers the inflector
     */
    public function test_it_registers_inflector()
    {
        $this->assertInstanceOf('League\Tactician\Handler\MethodNameInflector\MethodNameInflector',
            app('League\Tactician\Handler\MethodNameInflector\MethodNameInflector'));
    }

    /**
     * it registers the extractor
     */
    public function test_it_registers_extractor()
    {
        $this->assertInstanceOf('League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor',
            app('League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor'));
    }

}