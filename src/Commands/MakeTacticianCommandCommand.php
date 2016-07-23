<?php

namespace Joselfonseca\LaravelTactician\Commands;

use Illuminate\Console\GeneratorCommand;

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
        return __DIR__ . '/../../stubs/command.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "$rootNamespace\\CommandBus\\Commands";
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        return parent::getPath($name . "Command");
    }
}
