<?php

namespace Inmanturbo\Instances\Concerns;

use Sushi\Sushi;

trait ShouldKeepInstance
{
    use Sushi;

    public bool $shouldKeepInstance = true;

    public function sushishouldCache()
    {
        return false;
    }
}
