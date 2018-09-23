<?php

require __DIR__ . '/vendor/autoload.php';

use function \Chemem\Bingo\Functional\Algorithms\{concat, trampoline};
use Chemem\Bingo\Functional\Functors\Monads\IO;

const ARGS = [3, 4, 5, 6, 7];

function fib(int $val)
{
    return $val < 2 ? $val : fib($val - 1) + fib($val - 2);
}

function execTask($arg)
{
    return IO::of($arg)
        ->map(function ($arg) {
            return trampoline('fib')($arg);
        })
        ->map(function ($fib) use ($arg) {
            return printf('%s', concat(\PHP_EOL, concat(' ', 'fib', $arg, 'is', $fib), ''));
        });
}

function otherTask()
{
    return IO::of(function () {
        return function ($val) {
            return trampoline('fib')($val);
        };
    })
        ->ap(IO::of(10))
        ->map(function ($res) {
            return printf('%s', concat(' ', 'Other:', $res));
        });
}

foreach (ARGS as $arg) {
    $pid = pcntl_fork();

    if ($pid == -1) {
        exit('Error forking process');
    } else if ($pid == 0) {
        execTask($arg);
        exit();
    }
}

while(pcntl_waitpid(0, $status) != -1);

otherTask();