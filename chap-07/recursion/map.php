<?php

function mapRecursive(
  callable $func,
	array $list,
	int $count = 0,
	array $acc = []
) : array {
  $listCount = count($list);

  if ($count >= $listCount) {
    return $acc;
  }

  $acc[] = $func($list[$count]);

  return mapRecursive($func, $list, $count + 1, $acc);
}

var_dump(mapRecursive(fn (int $x): int => $x * 2, range(1, 5)));
