<?php

function map(callable $func, array $list, int $count = 0, array $acc = []) : array
{
    $listCount = count($list);

    if ($count >= $listCount) {
        return $acc;
    }

    $acc[] = $func($list[$count]);

    return map($func, $list, $count + 1, $acc);
}

map(function ($val) { return $val * 2; }, range(1, 5));