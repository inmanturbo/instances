<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;
use Inmanturbo\Instances\Facades\Instances;

class EnsureInstanceDoesNotAlreadyExist
{
    /**
     * Invoke the class instance.
     */
    public function __invoke(mixed $data, Closure $next)
    {
        if (Instances::instanceModel()::where('key', $data->model->getKey())->exists()) {
            return;
        }

        return $next($data);
    }
}
