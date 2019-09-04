Laravel Tactician
===============================

Laravel Tactician in an implementation of the Command Bus Tactician by Ross Tuck.

[![Build Status](https://travis-ci.org/joselfonseca/laravel-tactician.svg)](https://travis-ci.org/joselfonseca/laravel-tactician)
[![Code Coverage](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/joselfonseca/laravel-tactician/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4bef582c-187d-4cbe-bcf8-021d7d6e5f5d/small.png)](https://insight.sensiolabs.com/projects/4bef582c-187d-4cbe-bcf8-021d7d6e5f5d)

## Installation

To install this update your composer.json run `composer require joselfonseca/laravel-tactician` 

#### >= laravel5.5

ServiceProvider will be attached automatically.

#### Other

Once the dependencies have been downloaded, add the service provider to your config/app.php file:

```php
    'providers' => [
        ...
        Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class
        ...
    ]
```
You are done with the installation!

## Usage

To use the command bus you can resolve the bus from the laravel container like so:

```php
    $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
```

Or you can inject it into a class constructor:

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

Once you have the bus instance you can add your handler for the command to be dispatched:

```php
    $bus->addHandler('SomeCommand', 'SomeHandler');
```

Now you can dispatch the command with the middleware:

```php
    // first parameter is the class name of the command
    // Second parameter is an array of input data to be mapped to the command
    // Third parameter is an array of middleware class names to be added to the stack
    $bus->dispatch('SomeCommand', [], []);
```

You can map the input data array of the Command's _constructor_ with a plain list of arguments or the array itself. For example:

```php
    // Send parameters in an array of input data ...    
    $bus->dispatch('SomeCommand', [
        'propertyOne'   => 'One',
        'propertyTwo'   => 'Two',
        'propertyThree' => 'Three',
    ], []);
    
    // ... and receive them as individual parameters ... 
    Class SomeCommand {
        public function __construct($propertyOne = 'A', $propertyTwo = 'B', $propertyThree = 'C'){
            //...
        }
    }
    
    // ... or receive array of input data itself 
        Class SomeCommand {
            public function __construct(array $data = [
                'propertyOne'   => 'A',
                'propertyTwo'   => 'B',
                'propertyThree' => 'C',
            ]){
                //...
            }
        }
```

Of course, you can use default values!

For more information about the usage of the tactician command bus please visit [http://tactician.thephpleague.com/](http://tactician.thephpleague.com/).

## Example

Check out this example of the package implemented in a simple create order command [https://gist.github.com/joselfonseca/24ee0e96666a06b16f92](https://gist.github.com/joselfonseca/24ee0e96666a06b16f92).

## Bindings

You can configure the bindings for the locator, inflector, extractor and default bus by publishing the config file like so:

```bash
    php artisan vendor:publish
```

Then you can modify each class name and they will be resolved from the laravel container:

```php
    return [
        // The locator to bind
        'locator' => 'Joselfonseca\LaravelTactician\Locator\LaravelLocator',
        // The inflector to bind
        'inflector' => 'League\Tactician\Handler\MethodNameInflector\HandleInflector',
        // The extractor to bind
        'extractor' => 'League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor',
        // The bus to bind
        'bus' => 'Joselfonseca\LaravelTactician\Bus'
    ];
```

## Generators

You can generate Commands and Handlers automatically using artisan:

```
artisan make:tactician:command Foo
artisan make:tactician:handler Foo
```

This will create FooCommand and FooHandler and place them in the `app/Commands` folder, please note that the words `Command` and `Handler` will be added to the class names respectively, so in the avobe example the clases created will be `FooCommand` and `FooHandler`.

To run both at once:

```
artisan make:tactician Foo
```

## Middleware included

Laravel tactician includes some useful middleware you can use in your commands.

- Database Transactions: This Middleware will run the command inside a database transaction, if any exception is thrown the transaction won't be committed and the database will stay intact, you can find this middleware in `Joselfonseca\LaravelTactician\Middleware\DatabaseTransactions`.  

## Change log

Please see the releases page [https://github.com/joselfonseca/laravel-tactician/releases](https://github.com/joselfonseca/laravel-tactician/releases)

## Tests

To run the tests in this package, navigate to the root folder of the project and run:

```bash
    composer install
```
Then

```bash
    vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email jose at ditecnologia dot com instead of using the issue tracker.

## Credits

- [Jose Luis Fonseca](https://github.com/joselfonseca)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](license.md) for more information.
