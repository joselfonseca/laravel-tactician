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
Once the dependencies have been downloaded, add the service provider to your config/app.php file

```php
    'providers' => [
        ...
        Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class
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

For more information about the usage of the tactician command bus please visit [http://tactician.thephpleague.com/](http://tactician.thephpleague.com/)

## Example

Check out this example of the package implemented in a simple create order command [https://gist.github.com/joselfonseca/24ee0e96666a06b16f92](https://gist.github.com/joselfonseca/24ee0e96666a06b16f92)

##Bindings

You can configure the bindings for the locator, inflector, extractor and default bus publishing the config file like so
 
```bash
    php artisan vendor:publish 
``` 

Then you can modify each class name and they will be resolved from the laravel container

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

##Tests

To run the test in this package, navigate to the root folder of the project and run

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

The MIT License (MIT). Please see [License File](docs/license.md) for more information.