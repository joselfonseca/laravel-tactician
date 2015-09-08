<?php

namespace Joselfonseca\LaravelTactician\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelTacticianServiceProvider extends ServiceProvider{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('League\Tactician\Handler\Locator\HandlerLocator', 'Joselfonseca\LaravelTactician\Locator\LaravelLocator');
        $this->app->bind('League\Tactician\Handler\MethodNameInflector\MethodNameInflector', 'League\Tactician\Handler\MethodNameInflector\HandleInflector');
        $this->app->bind('League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor', 'League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor');
    }

}