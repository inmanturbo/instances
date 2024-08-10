<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;
use Inmanturbo\Instances\Concerns\GetsNextTally;
use Inmanturbo\Instances\Facades\Instances;

class StoreDeletedInstance
{
    use GetsNextTally;

    /**
     * Invoke the class instance.
     */
    public function __invoke(mixed $data, Closure $next)
    {
        Instances::modelClass()::create([
            'event' => $data->event,
            'model' => $data->model->getMorphClass(),
            'key' => $data->model->getKey(),
            'tally' => $this->getNextTally($data->model->getKey()),
            'property' => 'guid',
            'value' => $data->model->getKey(),
            'values' => $data->attributes,
        ]);

        return $next($data);
    }
}
