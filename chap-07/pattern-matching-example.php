<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Algorithms as A;

const POSTS = [
    [
        'id' => 1,
        'title' => 'Functional Programming Rocks',
        'text' => 'fp is amazing.'
    ],
    [
        'id' => 2,
        'title' => 'Cannot wait for Star Wars Ep9',
        'text' => 'Kylo Ren vs Rey part III.'
    ]
];

const ERROR = [
    'code' => 404,
    'error' => 'Resource Not Found'
];

const matchFn = 'FunctionalPHP\\PatternMatching\\match';

function resolvePath(string $path) : string
{
    $result = A\compose(
        A\partialLeft('explode', '/'),
        A\partialLeft(
            matchFn,
            [
                '["post", id]' => function (string $id) {
                    $res = A\compose(
                        A\partialLeft(A\filter, function (array $post) use ($id) { return A\pluck($post, 'id') == (int) $id; }),
                        A\head
                    );

                    return $res(POSTS);
                },
                '["posts"]' => function () { return A\identity(POSTS); },
                '_' => function () { return A\identity(ERROR); }
            ] 
        ),
        'json_encode'
    );

    return $result($path);
}

echo resolvePath('ringer');