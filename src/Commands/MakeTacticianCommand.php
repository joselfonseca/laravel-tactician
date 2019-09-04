<?php

namespace Joselfonseca\LaravelTactician\Commands;

use Illuminate\Console\Command;

/**
 * Generate Tactician Command and Handler
 * @package Joselfonseca\LaravelTactician\Commands
 */
class MakeTacticianCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tactician {command}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Tactician Command and Handler';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('make:tactician:command', $this->getNameArgument());
        $this->call('make:tactician:handler', $this->getNameArgument());
    }

    /**
     * @return array
     */
    public function getNameArgument()
    {
        return ['name' => $this->argument('name')];
    }
}
