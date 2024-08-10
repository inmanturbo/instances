<?php

namespace Inmanturbo\Instances\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Inmanturbo\Instances\InstancesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Inmanturbo\\Instances\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            InstancesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_instances_table.php.stub';
        $migration->up();
        */
    }
}
