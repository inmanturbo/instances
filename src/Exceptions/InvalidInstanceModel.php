<?php

namespace Inmanturbo\Instances\Exceptions;

use Exception;

class InvalidInstanceModel extends Exception
{
    public static function create(string $model): self
    {
        return new self("The model `{$model}` is invalid. A valid model must extend the model Inmanturbo\Instances\Models\Instance.");
    }
}
