<?php

require __DIR__ . '/../vendor/autoload.php';

use Chemem\Bingo\{
  Functional as f,
  Functional\PatternMatching as p
};

const POSTS = [
  [
    'id'    => 1,
    'title' => 'Functional Programming Rocks',
    'text'  => 'fp is amazing.',
  ],
  [
    'id'    => 2,
    'title' => 'Cannot wait for Star Wars Ep9',
    'text'  => 'Kylo Ren vs Rey part III.',
  ],
];

const ERROR = [
  'code'  => 404,
  'error' => 'Resource Not Found',
];

function router(string $path): string
{
  $routeTo = f\compose(
		f\partial('explode', '/'),
		f\partial(p\patternMatch, [
			'["post", id]' => function (string $id) {
			  $intval = (int) $id;

			  return isset(POSTS[$intval]) ?
					f\addKeys(POSTS, $intval)  :
					[
						'code'  => 404,
						'error' => 'Not found',
					];
			},
			'["posts"]' => fn () => POSTS,
			'_'         => fn () => [
				'code'  => 400,
				'error' => 'Bad Request',
			],
		]),
		f\partialRight('json_encode', JSON_PRETTY_PRINT)
	);

  return $routeTo($path);
}

echo router('posts');
