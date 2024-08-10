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
            ->hasMigration('2024_08_09_131035_create_instances_tables')
            ->hasCommand(InstancesCommand::class);
    }

    public function packageRegistering()
    {
        $this->app->singleton(Instances::class);
    }

    public function packageBooted()
    {
        Facades\Instances::bootListeners();
    }
}
