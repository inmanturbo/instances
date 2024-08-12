<?php

use Illuminate\Support\Facades\Pipeline;

use function Inmanturbo\Pipes\pipe;

it('can pipe', function () {

    $add = fn ($number) => $number + 1;

    $totalOne = pipe($add, 1)
        ->pipe($add)
        ->pipe($add)
        ->pipe($add)
        ->thenReturn();

    expect($totalOne)->toBe(5);

    $totalTwo = pipe($add, 1)
        ->pipe($add)
        ->pipe($add)
        ->pipe($add)
        ->then(fn ($number) => ++$number);

    expect($totalTwo)->toBe(6);
});

it('can pipe line', function () {

    $add = fn ($number) => $number + 1;

    $pipe = function ($payload) {
        return function ($passable, $next) use ($payload) {

            return $next($payload($passable));
        };
    };

    $limitMiddleware = function ($number, $next) {
        if ($number > 3) {
            // dump('number exeeded 3');
        }

        return $next($number);
    };

    $totalOne = Pipeline::send(1)
        ->pipe($pipe(fn ($number) => $number + 1))
        ->pipe($pipe(fn ($number) => $number + 1))
        ->pipe($pipe(fn ($number) => $number + 1))
        ->pipe($pipe(fn ($number) => $number + 1))
        ->thenReturn();

    expect($totalOne)->toBe(5);

    $totalTwo = Pipeline::send(1)
        ->pipe($pipe($add))
        ->pipe($pipe($add))
        ->pipe($pipe($add))
        ->pipe($pipe($add))
        ->then(fn ($number) => $number + 1);

    expect($totalTwo)->toBe(6);
});

it('can pipe one', function () {

    $add = fn ($number) => $number + 1;

    $totalOne = pipe(1)
        ->pipe($add)
        ->pipe($add)
        ->pipe($add)
        ->thenReturn();

    expect($totalOne)->toBe(4);

    $totalTwo = pipe(1)
        ->pipe($add)
        ->pipe($add)
        ->pipe($add)
        ->then(fn ($number) => ++$number);

    expect($totalTwo)->toBe(5);
});

function limitMiddleware()
{
    return function ($number, $next) {
        if ($number > 2) {
            echo $number;
        }

        return $next($number);
    };
}
