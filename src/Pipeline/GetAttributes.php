<?php

namespace Inmanturbo\Instances\Pipeline;

use Closure;
use Illuminate\Support\Facades\Pipeline;

class GetAttributes
{
    /**
     * Invoke the class instance.
     */
    public function __invoke($data, Closure $next)
    {
        $data->attributes = Pipeline::send($data)
            ->through($this->attributePipes())
            ->thenReturn()
            ->attributes;

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
