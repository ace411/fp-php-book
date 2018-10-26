<?php

require __DIR__ . '/vendor/autoload.php';

use Tries\Trie;
use Chemem\Bingo\Functional\Functors\Monads\IO;
use Chemem\Bingo\Functional\Functors\Monads as M;
use function Chemem\Bingo\Functional\Algorithms\partialRight;
use function Chemem\Bingo\Functional\Algorithms\compose;
use function Chemem\Bingo\Functional\Algorithms\partial;

function createTrie(array $json, int $init = 0) : Trie
{
    $trie = new Trie;
    $valCount = count($json);

    $add = function (int $init = 0) use (&$add, $json, $valCount, $trie) {
        if ($init >= $valCount) {
            return $trie;
        }

        $trie->add($json[$init]['char_name'], $json[$init]);
        return $add($init + 1);
    };
    return $add();
}

function searchTrie(string $entry) : IO
{
    $result = M\mcompose(function (string $contents) use ($entry) {
        $res = compose(partialRight('json_decode', true), 'createTrie', function ($trie) use ($entry) {
            return $trie->search($entry);
        });
        return IO\IO($res($contents));
    }, IO\readFile);

    return $result(IO\IO(__DIR__ . '/starwars_characters.json'));
}

print_r(searchTrie('Luke')->exec());