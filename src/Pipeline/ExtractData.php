<?php

namespace Inmanturbo\Ecow\Pipeline;

use Closure;
use Illuminate\Support\Facades\Pipeline;
use Inmanturbo\Ecow\Facades\Ecow;

class ExtractData
{
    /**
     * Invoke the class instance.
     */
    public function __invoke($data, Closure $next)
    {
        $data->attributes = Pipeline::send($data)
            ->through($this->attributePipes())->then(fn($data) => $data->attributes);

        return $next($data);
    }

    public function attributePipes()
    {
        return [
            function ($data, $next) {
                $data->hidden = $data->model->getHidden();

                return $next($data);
            },

            function ($data, $next) {
                $data->cloned = clone $data->model;

                return $next($data);
            },

            function ($data, $next) {
                $data->cloned->makeVisible($data->hidden);

                return $next($data);
            },

            function ($data, $next) {
                $data->attributes = $data->cloned->attributesToArray();

                return $next($data);
            },

        ];
    }
}
