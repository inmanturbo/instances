<?php

namespace Inmanturbo\Instances\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Inmanturbo\Instances\Instances
 */
class Instances extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Inmanturbo\Instances\Instances::class;
    }
}
