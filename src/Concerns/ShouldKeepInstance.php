<?php

namespace Inmanturbo\Instances\Concerns;

use Sushi\Sushi;

trait ShouldKeepInstance
{
    use Sushi;

    public bool $shouldKeepInstance = true;

    public $incrementing = false;

    protected $guarded = [];

    protected $rows = [
        //
    ];

    public function sushishouldCache()
    {
        return false;
    }
}
