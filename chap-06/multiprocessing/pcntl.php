<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../task.php';

if (!extension_loaded('pcntl')) {
  exit();
}

use function \Chemem\Bingo\Functional\trampoline;
use Chemem\Bingo\Functional\Functors\{
  Monads\IO,
  Monads as m
};

const ARGS = [3, 4, 5, 6, 7];

function execTask($arg): IO
{
  global $fib;

  return m\bind(
    IO\putStr,
    IO\IO(fn () => $arg)->map(fn ($arg) => trampoline($fib)($arg))
  );
}

foreach (ARGS as $arg) {
  $pid = pcntl_fork();

  if ($pid == -1) {
    exit('Error forking process');
  } else {
    if ($pid == 0) {
      execTask($arg);
      exit();
    }
  }
}

while (pcntl_waitpid(0, $status) != -1);

execTask(10)->exec();
