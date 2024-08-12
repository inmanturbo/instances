# An single table store for storing eloquent model instances

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
    /*
     * Enable or disable the event listeners.
     */
    'enabled' => env('INSTANCES_ENABLED', true),

    /*
     * The model used to store instances.
     */
    'instance_model' => \Inmanturbo\Instances\Models\Instance::class,

    /*
     * The model used to store snapshots.
     */
    'snapshot_model' => \Inmanturbo\Instances\Models\InstanceSnapshot::class,

    /*
     * The number of days to keep instances.
     */
    'prune_after_days' => 365 * 1000000, // wouldn't delete this in a million years,

    /*
     * The table name used to store instances.
     *
     * Changing it is not supported at this time.
     * 
     * It's here for reference and to be used by the `instances:migrate` command.
     */
    'instance_table' => 'instances',

    /*
     * The table name used to store snapshots.
     *
     * Changing it is not supported at this time.
     * 
     * It's here for reference and to be used by the `instances:migrate` command.
     */

    'snapshot_table' => 'instance_snapshots',

    /*
     * These tables will be created when running the migration.
     *
     * They will be dropped when running `php artisan instances:migrate --fresh`.
     */
    'migration_tables' => [
        'instances',
        'instance_snapshots',
    ],
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
- [spatie/laravel-event-sourcing](https://github.com/spatie/laravel-event-sourcing)
- [spatie/laravel-deleted-models](https://github.com/spatie/laravel-deleted-models)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
