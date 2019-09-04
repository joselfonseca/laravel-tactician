<?php

namespace Joselfonseca\LaravelTactician\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

/**
 * Create a new Tactician Command
 * @package Joselfonseca\LaravelTactician\Commands
 */
class MakeTacticianCommandCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:tactician:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Tactician Command';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/command.stub';
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
        return parent::getPath($name.'Command');
    }
}
