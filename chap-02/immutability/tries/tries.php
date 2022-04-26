<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\{
  Functional\Functors\Monads as m,
  Functional\Functors\Monads\IO,
  Functional as f
};

if (!extension_loaded('php_trie')) {
  exit();
}

function modifyKey(string $key): string
{
  $modify = f\compose('strtolower', f\partial('str_replace', ' ', '-'));

  return $modify($key);
}

function searchTrie(array $contents): IO
{
  $res = f\fold(function (HatTrie $trie, array $val): HatTrie {
    $trie[modifyKey($val['char_name'])] = $val['char_affiliation'];

    return $trie;
  }, $contents, new HatTrie);

  return IO\IO(fn () => $res);
}

$res = m\mcompose(
  fn ($data)          => (
    m\bind(fn ($trie) => (
      IO\IO(fn ()     => $trie->prefixSearch('l')->toArray())
    ), searchTrie(\json_decode($data, true)))
  ),
  IO\readFile
);

var_dump(
  $res(IO\IO(fn () => __DIR__ . '/starwars_characters.json'))
    ->exec()
);
