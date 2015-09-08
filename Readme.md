Laravel Tactician
===============================

Laravel Tactician in an implementation of the Command Bus Tactician by Ross Tuck.

[![Build Status](https://travis-ci.org/joselfonseca/laravel-tactician.svg)](https://travis-ci.org/joselfonseca/laravel-tactician)
[![Code Coverage](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/?branch=master)

##Installation

To install this package run

```bash
    composer require joselfonseca/laravel-tactician
```
Once the dependencies have been downloaded, add he service provider to your config/app.php file

```php
    'providers' => [
        ...
        Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider
        ...
    ]
```
You are done with the installation!

##Usage

To use the command bus you can resolve the bus from the laravel container like so

```php
    $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
```
Or you can inject it into a class constructor

```php
    
    use Joselfonseca\LaravelTactician\CommandBusInterface;
    
    class MyController extends BaseController
    {
        
        public function __construct(CommandBusInterface $bus)
        {
            $this->bus = $bus;
        }
        
    }
    
```

Once you have the bus instance you can add your handler for the command to be dispatched

```php
    $bus->addHandler('SomeCommand', 'SomeHandler');
```
Now you can dispatch the command with the middleware.

```php
    // first parameter is the class name of the command
    // Second parameter is an array of input data to be mapped to the command
    // Third parameter is an array of middleware class names to be added to the stack
    $bus->dispatch('SomeCommand', [], []);
```