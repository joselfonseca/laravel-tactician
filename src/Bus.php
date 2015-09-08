<?php

namespace Joselfonseca\LaravelTactician;

use ReflectionClass;
use InvalidArgumentException;
use League\Tactician\CommandBus;
use League\Tactician\Handler\Locator\HandlerLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\MethodNameInflector;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;

/**
 * Class Bus
 * @package Joselfonseca\LaravelTactician
 */
class Bus implements CommandBusInterface
{

    /**
     * @var The Command Bus
     */
    protected $bus;
    /**
     * @var CommandNameExtractor
     */
    protected $CommandNameExtractor;
    /**
     * @var MethodNameInflector
     */
    protected $MethodNameInflector;
    /**
     * @var HandlerLocator
     */
    protected $HandlerLocator;


    /**
     * @param MethodNameInflector $MethodNameInflector
     * @param CommandNameExtractor $CommandNameExtractor
     * @param HandlerLocator $HandlerLocator
     */
    public function __construct(
        MethodNameInflector $MethodNameInflector,
        CommandNameExtractor $CommandNameExtractor,
        HandlerLocator $HandlerLocator
    ) {
        $this->MethodNameInflector = $MethodNameInflector;
        $this->CommandNameExtractor = $CommandNameExtractor;
        $this->HandlerLocator = $HandlerLocator;
    }

    /**
     * Dispatch a command
     * @param object $command Command to be dispatched
     * @param array $input Array of input to map to the command
     * @param array $middleware Array of middleware class name to add to the stack,
     * they are resolved fro the laravel container
     * @return mixed
     */
    public function dispatch($command, array $input = [], array $middleware = [])
    {
        return $this->handleTheCommand($command, $input, $middleware);
    }

    /**
     * Add the Command Handler
     * @param string $command Class name of the command
     * @param string $handler Class name of the handler to be resolved from the Laravel Container
     * @return mixed
     */
    public function addHandler($command, $handler)
    {
        $this->HandlerLocator->addHandler($handler, $command);
    }

    /**
     * Handle the command
     * @param $command
     * @param $input
     * @param $middlewares
     * @return mixed
     */
    protected function handleTheCommand($command, $input, array $middleware)
    {
        $this->bus = new CommandBus(array_merge($this->resolveMiddleware($middleware),
            [
                new CommandHandlerMiddleware($this->CommandNameExtractor,
                    $this->HandlerLocator, $this->MethodNameInflector)
            ]));
        return $this->bus->handle($this->mapInputToCommand($command, $input));
    }

    /**
     * Resolve the middleware stack from the laravel container
     * @param $middleware
     * @return array
     */
    protected function resolveMiddleware(array $middleware)
    {
        $m = [];
        foreach ($middleware as $class) {
            $m[] = app($class);
        }

        return $m;
    }

    /**
     * Map the input to the command
     * @param $command
     * @param $input
     * @return object
     */
    protected function mapInputToCommand($command, $input)
    {
        $dependencies = [];
        $class = new ReflectionClass($command);
        foreach ($class->getConstructor()->getParameters() as $parameter) {
            $name = $parameter->getName();
            if (array_key_exists($name, $input)) {
                $dependencies[] = $input[$name];
            } elseif ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                throw new InvalidArgumentException("Unable to map input to command: {$name}");
            }
        }

        return $class->newInstanceArgs($dependencies);
    }

}