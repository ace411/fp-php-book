<?php

require __DIR__ . '/vendor/autoload.php';

use \Chemem\Bingo\Functional\Algorithms as A;

class Calculator
{
    private $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public static function of(float $value) : Calculator
    {
        return new static($value);
    }

    public function map(callable $function) : Calculator
    {
        return self::of($this->flatMap($function));
    }

    public function flatMap(callable $function) : float
    {
        return (float) $function($this->value);
    }
}

$calc = Calculator::of(12);

$pow = A\partialRight('pow', 4);

$ops = function (float $val) : float { return ($val / 3) - 2.5; };

//identity

var_dump(
    assert(($calc->map(A\identity) == A\identity($calc)), 'Identity proof violation')
);

//composition

var_dump(
    assert(($calc->map($pow)->map($ops) == $calc->map(A\compose($pow, $ops))), 'Composition violation')
);