<?php

namespace Joselfonseca\LaravelTactician;

use ReflectionClass;
use InvalidArgumentException;
use League\Tactician\CommandBus;
use League\Tactician\Handler\Locator\HandlerLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\MethodNameInflector;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;

class Bus
{

    /**
     * @var
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
     *
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
     * @param $command
     * @param array $input
     * @param array $middlewares
     * @return mixed
     */
    public function dispatch($command, array $input = [], array $middleware = []) {
        return $this->handleTheCommand($command, $input, $middleware);
    }

    /**
     * @param $command
     * @param $handler
     */
    public function addHandler($command, $handler)
    {
        $this->HandlerLocator->addHandler($handler, $command);
    }

    /**
     * @param $middlewares
     * @return array
     */
    protected function instanciateMiddlewares($middlewares)
    {
        if (!is_array($middlewares)) {
            throw new InvalidArgumentException('Middlewares parameter is not an Array');
        }
        $m = [];
        foreach ($middlewares as $class) {
            if (!class_exists($class)) {
                throw new InvalidArgumentException('The class ' . $class . ' does not exists');
            }
            $m[] = new $class;
        }
        return $m;
    }

    /**
     * @param $command
     * @param $input
     * @param $middlewares
     * @return mixed
     */
    protected function handleTheCommand($command, $input, $middleware)
    {
        $commandHandlerMiddleware = new CommandHandlerMiddleware($this->CommandNameExtractor,
            $this->HandlerLocator, $this->MethodNameInflector);
        $this->bus = new CommandBus(array_merge($this->instanciateMiddlewares($middleware),
            [$commandHandlerMiddleware]));
        return $this->bus->handle($this->mapInputToCommand($command, $input));
    }

    /**
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