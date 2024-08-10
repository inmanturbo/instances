<?php

namespace Inmanturbo\Instances\Concerns;

use Inmanturbo\Instances\Facades\Instances;

trait GetsNextTally
{
    public function getNextTally(string $key): int
    {
        return Instances::instanceModel()::where('key', $key)
            ->max('tally') + 1;
    }
}