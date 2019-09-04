<?php

namespace Joselfonseca\LaravelTactician\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

/**
 * Create a new Tactician Command Handler
 * @package Joselfonseca\LaravelTactician\Commands
 */
class MakeTacticianHandlerCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:tactician:handler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Tactician Command Handler';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/handler.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        return str_replace('DummyCommand', class_basename($name), parent::buildClass($name));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Commands';
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return parent::getPath($name.'Handler');
    }
}
