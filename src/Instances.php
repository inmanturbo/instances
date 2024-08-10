<?php

namespace Inmanturbo\Instances;

use Inmanturbo\Instances\Pipeline\CheckIfInstanceExists;
use Inmanturbo\Instances\Pipeline\EnsureInstanceShouldBeSaved;
use Inmanturbo\Instances\Pipeline\FillModel;
use Inmanturbo\Instances\Pipeline\FilterValues;
use Inmanturbo\Instances\Pipeline\GetAttributes;
use Inmanturbo\Instances\Pipeline\StoreFirstInstance;
use Inmanturbo\Instances\Pipeline\StoreNewInstance;
use Inmanturbo\Modelware\Facades\Modelware;

class Instances
{
    public bool $disabled = false;

    public function instanceModel(): string
    {
        $modelClass = config('instances.instance_model');

        if ($modelClass === Models\Instance::class || is_subclass_of($modelClass, Models\Instance::class)) {
            return $modelClass;
        }

        throw Exceptions\InvalidInstanceModel::create($modelClass);
    }

    public function snapshotModel(): string
    {
        $modelClass = config('instances.snapshot_model');

        if ($modelClass === Models\InstanceSnapshot::class || is_subclass_of($modelClass, Models\InstanceSnapshot::class)) {
            return $modelClass;
        }

        throw Exceptions\InvalidSnapshotModel::create($modelClass);
    }

    public function newSnapshotModel(): Models\InstanceSnapshot
    {
        $modelClass = $this->snapshotModel();

        return new $modelClass;
    }

    public function newInstanceModel(): Models\Instance
    {
        $modelClass = $this->instanceModel();

        return new $modelClass;
    }

    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function disable(): void
    {
        $this->disabled = true;
    }

    public function enable(): void
    {
        $this->disabled = false;
    }

    public function bootListeners(): void
    {
        if ($this->isDisabled()) {
            return;
        }

        if (config('instances.disabled', false)) {
            return;
        }

        $this->listenForCreatingEvents();
    }

    public function listenForCreatingEvents(): void
    {
        $this->listen('eloquent.creating*', [
            EnsureInstanceShouldBeSaved::class,
            GetAttributes::class,
            CheckIfInstanceExists::class,
            StoreFirstInstance::class,
            StoreNewInstance::class,
            FilterValues::class,
            FillModel::class,
        ]);
    }

    public function listen(string $event, array $pipes): void
    {
        Modelware::add($event, $pipes, prefix: 'instances');
    }
}
