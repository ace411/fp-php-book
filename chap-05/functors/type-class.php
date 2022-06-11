<?php

class Calculator
{
  private int $value;

  public function __construct(int $value)
  {
    $this->value = $value;
  }

  public function operation(callable $operation): Calculator
  {
    return self::get($operation($this->value));
  }

  public static function get(int $value): Calculator
  {
    return new static($value);
  }
}