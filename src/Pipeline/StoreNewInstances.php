<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;
use Illuminate\Support\Facades\DB;
use Inmanturbo\Instances\Concerns\GetsNextTally;
use Inmanturbo\Instances\Facades\Instances;

class StoreNewInstances
{
    use GetsNextTally;

    /**
     * Invoke the class instance.
     */
    public function __invoke($data, Closure $next)
    {
        DB::transaction(function () use (&$data) {

            foreach ($data->model->getDirty() as $property => $value) {
                $newInstance = Instances::newInstanceModel()->forceCreate([
                    'event' => $data->event,
                    'model' => $data->model->getMorphClass(),
                    'key' => $data->model->getKey(),
                    'tally' => $this->getNextTally($data->model->getKey()),
                    'model' => $data->model->getMorphClass(),
                    'values' => $data->attributes,
                    'property' => $property,
                    'value' => $value,
                ]);

                $data->attributes[$newInstance->property] = $newInstance->value;
            }
        });

        return $next($data);
    }
}
