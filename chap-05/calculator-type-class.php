<?php

class Calculator
{
  private int $value;

  public function __construct(int $value)
  {
    $this->value = $value;
  }

  public static function get(int $value): Calculator
  {
    return new static($value);
  }

  public function operation(callable $operation): Calculator
  {
    return self::get($operation($this->value));
  }
}

$calc = Calculator::get(1)
  ->operation(fn (int $val): int => $val + 10)
  ->operation(fn (int $val): int => $val - 5)
  ->operation(fn (int $val): int => $val * 3);
