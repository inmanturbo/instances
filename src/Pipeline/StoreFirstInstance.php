<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;
use Inmanturbo\Instances\Facades\Instances;

class StoreFirstInstance
{
    /**
     * Invoke the class instance.
     */
    public function __invoke(mixed $data, Closure $next)
    {
        if ($data->exist) {
            return $next($data);
        }

        $data->attributes = ($data->instance = Instances::instanceModel()::create([
            'event' => $data->event,
            'model' => $data->model->getMorphClass(),
            'key' => $data->model->getKey(),
            'tally' => 1,
            'values' => $data->model->getDirty(),
            'attributes' => $data->attributes,
        ]))->values;

        return $next($data);
    }
}
