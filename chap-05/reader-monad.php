<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\{
  Algorithms as f,
  Functors\Monads as m,
  Functors\Monads\Reader
};

const CONFIG = [
  'lang'      => 'php',
  'baseUri'   => 'http://oursite:{port}',
  'port'      => '400',
  'endpoints' => ['versions', 'posts'],
];

function schemeToPort(array $config): string
{
  $pluck = f\partial(f\pluck, $config);

  return str_replace('{port}', $pluck('port'), $pluck('baseUri'));
}

function addPath(string $url): Reader
{
  return Reader\reader(function (array $config) use ($url) {
    [$versions, $posts] = f\pluck($config, 'endpoints');

    return concat('/', $url, (
      f\pluck($config, 'lang') == 'php' ?
        $versions :
        $posts
    ));
  });
}

$url = Reader\runReader(
  m\bind('addPath', Reader\reader('schemeToPort')),
  CONFIG
);

echo $url;
