<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\IO;
use function Chemem\Bingo\Functional\Functors\Monads\{bind, mcompose};

/**
 *
 * main function
 * core REPL function
 *
 * main :: IO ()
 *
 * @return object IO
 */

function main(): IO
{
  $repl = mcompose(function (string $cmd): IO {
    return bind(IO\putStr, Project\toAction($cmd));
  }, IO\getLine, IO\putStr);

  return $repl(IO\IO(Project\CONSOLE_PROMPT));
}

while (true) {
  main()->exec();
}
