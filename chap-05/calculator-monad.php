<?php

class Calculator
{
  private float $value;

  public function __construct(float $value)
  {
    $this->value = $value;
  }

  public static function of(float $value): Calculator
  {
    return new static($value);
  }

  public function map(callable $function): Calculator
  {
    return self::of($this->flatMap($function));
  }

  public function flatMap(callable $function): float
  {
    return (float) $function($this->value);
  }

  public function bind(callable $function): Calculator
  {
    return $function($this->value);
  }

  public function exec(): float
  {
    return $this->value;
  }
}
