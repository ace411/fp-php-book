<?php

class Operation
{
  private $x;

  private $y;

  public function __construct(int $x, int $y)
  {
    $this->x = $x;
    $this->y = $y;
  }

  public function add() : int
  {
    return $this->x + $this->y;
  }
}

$op = new Operation(1, 2);

var_dump($op->add());
