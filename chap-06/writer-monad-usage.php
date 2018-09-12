<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\{
    Algorithms as A,
    Functors\Monads\IO,
    Functors\Monads\Writer
};

const FILES = [
    'person.jpg',
    'landscape.png',
    'animal.jpg'
];

function write(string $file, string $data) : IO
{
    return IO::of($file)
        ->map(A\partialRight('file_put_contents', $data));
}

list($result, $log) = Writer::of(FILES, 'Added image list')
    ->flatMap(
        function (array $files) {
            $jpg = A\filter(function (string $file) { return in_array('jpg', explode('.', $file)); }, $files);

            return A\map(
                function (string $file) {
                    $rename = A\compose(
                        A\partialLeft('explode', '.'),
                        A\partialRight(A\fill, 1, 1, '_resized.jpg'),
                        A\partialLeft('implode', '')
                    );

                    return $rename($file);
                },
                $jpg
            );
        }, 
        'Resized jpg files'
    );

write(A\concat('/', __DIR__, 'log.txt'), $log);
