<?php

const factorial = 'factorial';

function factorial(int $val)
{
    return $val < 2 ? 1 : factorial($val - 1) * $val;
}

const evenFilter = 'evenFilter';

function evenFilter(int $val)
{
    return $val % 2 == 0;
}

const minVal = 'minVal';

function minVal(int $start, int $value)
{
    return $value < $start ? $value : $start;
}

const multipleOp = 'multipleOp';

function multipleOp(int $valX, int $valY, string $valZ)
{
    return is_numeric($valZ) ? ($valX + $valY) / $valZ : $valX + $valY;
}

const checkActivation = 'checkActivation';

function checkActivation(array $user)
{
    return is_bool($user['activated']) ? $user['activated'] : false;
}