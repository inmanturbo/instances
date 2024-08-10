<?php

use Inmanturbo\Instances\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

uses()
    ->beforeEach(function () {
        $this->artisan('instances:migrate')->assertExitCode(0);
    })
    ->in('Feature');
