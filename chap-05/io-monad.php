<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\{
  Monads as m,
  Monads\IO
};

$read = m\mcompose(fn (string $contents) => (
  IO\IO(fn ()                            => strtoupper($contents))
),IO\readFile);

echo $read(IO\IO(fn () => __DIR__ . '/file.txt'))->exec();
