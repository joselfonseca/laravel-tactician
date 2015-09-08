<?php

namespace Joselfonseca\LaravelTactician\Tests\Providers;


use Joselfonseca\LaravelTactician\Tests\TestCase;

class TestProvider extends TestCase{

    public function test_it_loads_service_provider()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider',
            app()->getProvider('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider'));
    }

}