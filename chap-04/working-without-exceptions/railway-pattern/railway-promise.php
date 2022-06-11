<?php

require __DIR__ . '/vendor/autoload.php';

use React\Promise\Promise;
use Chemem\Bingo\Functional as f;

function addTen(int $val): Promise
{
  return new Promise(fn (callable $res, callable $rej) => (
    $val > 20 ? $res($val + 10) : $rej(0)
  ));
}

function squareCubeRoot(int $val): Promise
{
  return new Promise(fn (callable $res, callable $rej) => (
    !is_float((int) ($val ** (1 / 3))) ? $res($val ** 2) : $rej(0)
  ));
}

$final = addTen(54)
  ->then('squareCubeRoot', f\identity)
  ->then(function ($ret) {
    echo $ret;
  });
