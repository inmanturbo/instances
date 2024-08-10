<?php

namespace Inmanturbo\Instances;

use Inmanturbo\Modelware\Facades\Modelware;

class Instances
{
    public bool $disabled = false;

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
        $this->listenForUpdatingEvents();
        $this->listenForDeletingEvents();
    }

    public function listenForCreatingEvents(): void
    {
        $this->listen('creating', [
            // todo: add your pipes here
        ]);
    }

    public function listenForUpdatingEvents(): void
    {
        $this->listen('updating', [
            // todo: add your pipes here
        ]);
    }

    public function listenForDeletingEvents(): void
    {
        $this->listen('deleting', [
            // todo: add your pipes here
        ]);
    }

    public function listen(string $event, array $pipes): void
    {
        Modelware::add($event, $pipes, prefix: 'instances');
    }
}
