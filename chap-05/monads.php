<?php

require __DIR__ . '/vendor/autoload.php';

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

    public static function return(float $value) : Calculator
    {
        return self::of($value);
    }

    public function map(callable $function) : Calculator
    {
        return self::of($this->flatMap($function));
    }

    public function flatMap(callable $function) : float
    {
        return (float) $function($this->value);
    }

    public function bind(callable $function) : Calculator
    {
        return $function($this->exec());
    }

    public function exec() : float
    {
        return (float) $this->value;
    }
}

$calc = Calculator::return(15);

$pow = function (float $val) { return Calculator::of(pow($val, 4)); };

$ops = function (float $val) { return Calculator::of(($val / 3) - 2.5); };

//left-identity

var_dump(
    assert($calc->bind($pow) == $pow(15), 'Left identity violation')
);

//right identity

var_dump(
    assert(Calculator::return(15) == (new Calculator(15)), 'Right identity violation')
);

//associativity

var_dump(
    assert(
        $calc->bind($pow)->bind($ops) == $calc->bind(function ($x) use ($pow, $ops) { return $pow($x)->bind($ops); }), 
        'Associativity rule violation'
    )
);