<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;

class EnsureInstanceShouldBeSaved
{
    /**
     * Invoke the class instance.
     */
    public function __invoke(mixed $data, Closure $next)
    {
        if (isset($data->model->shouldKeepInstance) && $data->model->shouldKeepInstance === true) {
            return $next($data);
        }

    }
}
