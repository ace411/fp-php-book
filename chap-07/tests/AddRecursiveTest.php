<?php

require dirname(__DIR__) . '/add-recursive.php';

use Eris\Generator;

class AddRecursiveTest extends PHPUnit\Framework\TestCase
{
    use Eris\TestTrait;

    public function testAddRecursiveFunctionGeneratesArrayOutputBasedOnInteger()
    {
        $this->forAll(Generator\choose(1, 100))
            ->then(function (int $count) {
                $add = addRecursive($count);

                $this->assertInternalType('array', $add);
                $this->assertTrue(count($add) == $count + 1);
            });
    }
}