<?php

namespace Project;

use \Chemem\Bingo\Functional\Algorithms as A;
use \Chemem\Bingo\Functional\Functors\Monads\IO;
use function \Chemem\Bingo\Functional\PatternMatching\patternMatch;
use function \Chemem\Bingo\Functional\Functors\Monads\{bind, mcompose};

/**
 * 
 * toAction function
 * Transforms command into an action
 * 
 * toAction :: String -> IO ()
 * 
 * @param string $cmd
 * @return object IO
 */

const toAction = 'Project\\toAction';

function toAction(string $cmd) : IO
{
    return patternMatch(
        [
            '["add", name, phone]' => function (string $name, string $phone) {
                return bind(function ($result) use ($name) {
                    $json = A\compose(A\partial(A\concat, ' ', $name), IO\IO);
                    return $json($result ? 'added' : 'not added');
                }, create($name, $phone));
            },
            '["search", name]' => function (string $name) {
                return bind(formatOutput, search($name));
            },
            '["delete", name]' => function (string $name) {
                return bind(function ($result) use ($name) {
                    $json = A\compose(A\partial(A\concat, ' ', $name), IO\IO);
                    return $json($result ? 'deleted' : 'not deleted');
                }, delete($name));
            },
            '["all"]' => function () {
                return bind(formatOutput, connect());
            },
            '_' => function () {
                return IO\IO('Unrecognized input');
            }
        ],
        explode(' ', $cmd)
    );
}
