<?php

require __DIR__ . '/vendor/autoload.php';

use function Chemem\Bingo\Functional\Algorithms\partial;

function multipleOp(int $x, int $y, string $z): int
{
  return is_numeric($z) ? ($x + $y) / $z : $x + $y;
}

$partial  = partial('multipleOp', 12);

$final    = $partial(13, '5');

echo $final;
