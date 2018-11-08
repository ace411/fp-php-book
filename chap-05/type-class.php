<?php

class Calculator
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function get($value)
    {
        return new static($value);
    }

    public function operation(callable $function)
    {
        return self::of($function($this->value));
    }
}

$calc = Calculator::get(1)
	->operation(function ($val) { return $val + 10; })
	->operation(function ($val) { return $val - 5; })
	->operation(function ($val) { return $val * 3; });