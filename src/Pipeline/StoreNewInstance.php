<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;
use Inmanturbo\Instances\Concerns\GetsNextTally;
use Inmanturbo\Instances\Facades\Instances;

class StoreNewInstance
{
    use GetsNextTally;

    /**
     * Invoke the class instance.
     */
    public function __invoke($data, Closure $next)
    {
        if (! $data->exist) {
            return $next($data);
        }

        if (isset($data->model->tallyLimit) && $this->getNextTally($data->model->getKey()) > $data->model->tallyLimit) {
            $data->halt = true;
            return $next($data);
        }

        $data->newInstance = Instances::newInstanceModel()->forceCreate([
            'event' => $data->event,
            'model' => $data->model->getMorphClass(),
            'key' => $data->model->getKey(),
            'tally' => $this->getNextTally($data->model->getKey()),
            'model' => $data->model->getMorphClass(),
            'values' => $data->model->getDirty(),
            'attributes' => $data->attributes,
        ]);

        return $next($data);
    }
}
