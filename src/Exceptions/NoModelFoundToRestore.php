<?php

namespace Inmanturbo\Instances\Exceptions;

use Exception;

class NoInstanceFoundToRestore extends Exception
{
    public static function make(string $modelClass, mixed $key): self
    {
        return new self("Could not find a deleted model to restore for class `{$modelClass}` with key `{$key}`.");
    }
}
