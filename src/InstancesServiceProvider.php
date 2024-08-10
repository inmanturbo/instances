<?php

namespace Inmanturbo\Instances;

use Inmanturbo\Instances\Commands\InstancesCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InstancesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('instances')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_instances_table')
            ->hasCommand(InstancesCommand::class);
    }
}
