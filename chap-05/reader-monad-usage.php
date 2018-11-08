<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Functors\Monads\Reader;
use function Chemem\Bingo\Functional\Algorithms\{concat, pluck};

const CONFIG = [
    'lang' => 'php',
    'baseUri' => 'http://oursite:{port}',
    'port' => '400',
    'endpoints' => ['versions', 'posts']
];

const schemeToPort = 'schemeToPort';

function schemeToPort(array $config) : string
{
    return str_replace('{port}', pluck($config, 'port'), pluck($config, 'baseUri'));
}

const addPath = 'addPath';

function addPath(string $url) : Reader
{
    return Reader::of(
        function (array $config) use ($url) { 
            list($versions, $posts) = pluck($config, 'endpoints');

            return concat('/', $url, (pluck($config, 'lang') == 'php' ? $versions : $posts)); 
        }
    );
}

$url = Reader::of(schemeToPort)
    ->withReader(addPath)
    ->run(CONFIG);

echo $url;