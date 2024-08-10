<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;
use Inmanturbo\Instances\Facades\Instances;

class CheckIfInstanceExists
{
    /**
     * Invoke the class instance.
     */
    public function __invoke(mixed $data, Closure $next)
    {
        $data->exist = Instances::instanceModel()::where('key', $data->model->getKey())->exists();

        return $next($data);
    }
}
