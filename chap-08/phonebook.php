<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\IO;
use function Chemem\Bingo\Functional\Functors\Monads\{bind, mcompose};
use function Chemem\Bingo\Functional\Algorithms\{compose, constantFunction as cf};

/**
 * 
 * main function
 * core REPL function
 * 
 * main :: IO ()
 * 
 * @return object IO
 */

function main()
{
    $action = compose(
        cf(Project\replPrompt()),
        cf(mcompose(function ($fgets) {
            $repl = compose($fgets, Project\toAction, IO\IO);
            return $repl(\STDIN);
        }, IO\putStr)(IO\IO(null)))
    );

    return $action(null)->exec();
}

while (true) IO\_print(main());