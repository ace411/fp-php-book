<?php

const fibGenerate = 'fibGenerate';

function fibGenerate(int $start, int $end) : string
{
    $fibFn = function (int $val) use (&$fibFn) {
        return $val < 2 ? $val : $fibFn($val - 1) + $fibFn($val - 2);
    };

    $fibList = array_map($fibFn, range($start, $end));

    return json_encode($fibList, JSON_PRETTY_PRINT);
}