# An eloquent model instance based event store for laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inmanturbo/instances.svg?style=flat-square)](https://packagist.org/packages/inmanturbo/instances)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/inmanturbo/instances/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/inmanturbo/instances/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/inmanturbo/instances/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/inmanturbo/instances/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/inmanturbo/instances.svg?style=flat-square)](https://packagist.org/packages/inmanturbo/instances)

## Installation

You can install the package via composer:

```bash
composer require inmanturbo/instances
```

You can run the migrations with:

```bash
php artisan instances:migrate
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="instances-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="instances-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$instances = new Inmanturbo\Instances();
echo $instances->echoPhrase('Hello, Inmanturbo!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [inmanturbo](https://github.com/inmanturbo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
