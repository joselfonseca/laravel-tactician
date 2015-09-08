<?php

namespace Joselfonseca\LaravelTactician\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelTacticianServiceProvider
 * @package Joselfonseca\LaravelTactician\Providers
 */
class LaravelTacticianServiceProvider extends ServiceProvider
{

    /**
     * Do the bindings so any implementation can be swapped
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->app->bind('League\Tactician\Handler\Locator\HandlerLocator', config('laravel-tactician.locator'));
        $this->app->bind('League\Tactician\Handler\MethodNameInflector\MethodNameInflector', config('laravel-tactician.inflector'));
        $this->app->bind('League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor', config('laravel-tactician.extractor'));
        $this->app->bind('Joselfonseca\LaravelTactician\CommandBusInterface', config('laravel-tactician.bus'));
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes(
            [
            __DIR__.'/../../config/config.php' => config_path('laravel-tactician.php'),
            ]
        );
        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php',
            'laravel-tactician'
        );
    }
}
