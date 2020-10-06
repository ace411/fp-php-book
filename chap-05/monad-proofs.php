<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/calculator-monad.php';


$calc = Calculator::of(15);

$exp = fn (float $val): Calculator => Calculator::of($val ** 4);

$ops = fn (float $val): Calculator => Calculator::of(($val / 3) - 2.5);

// left-identity
echo assert($calc->bind($exp) == $exp(15), 'Left identity violation');

// right-identity
echo assert($calc == new Calculator(15), 'Right identity violation');

// associativity
echo assert(
  $calc->bind($exp)->bind($ops) == $calc->bind(fn (float $x) => $pow($x)->bind($ops)),
  'Associativity rule violation'
);
