<?php

require __DIR__ . '/vendor/autoload.php';

use Tries\Trie;
use Chemem\Bingo\Functional\Functors\Monads\IO;
use function Chemem\Bingo\Functional\Algorithms\partialRight;

function readFromFile(string $file) : IO
{
    $readFromFile = IO::of($file);

    return $readFromFile
        ->map('file_get_contents')
        ->map(partialRight('json_decode', true));
}

function createTrie(IO $fileReader) : Trie
{
    return $fileReader
        ->flatMap(
            function (array $contents) {
                $trie = new Trie();

                $addItem = function (int $init = 0) use ($contents, $trie, &$addItem) {
                    $valCount = count($contents);

                    if ($init >= $valCount) {
                        return $trie;
                    }

                    $trie->add(
                        $contents[$init]['char_name'],
                        $contents[$init]
                    );

                    return $addItem($init + 1);
                };

                return $addItem();
            }
        );
}

$trie = createTrie(
    readFromFile(__DIR__ . '/starwars_characters.json')
);

var_dump($trie->search('Luke'));