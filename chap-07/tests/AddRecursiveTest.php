<?php

require dirname(__DIR__) . '/add-recursive.php';

use Eris\Generator;

class AddRecursiveTest extends PHPUnit\Framework\TestCase
{
    use Eris\TestTrait;

    public function testAddRecursiveFunction()
    {
        $this->forAll()
            ->then(function (int $count) {

            });
    }
}