<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../add-recursive.php';

use Eris\Generator;
use function Chemem\Bingo\Functional\isArrayOf;

error_reporting(0); // For PHP 7.4 and greater

class MapFunctionTest extends PHPUnit\Framework\TestCase
{
  use Eris\TestTrait;

  public function testAddRecursiveFunctionGeneratesArrayOutputBasedOnInteger()
  {
    $this
      ->forAll(Generator\choose(1, 5))
      ->then(function (int $val) {
        $add = addRecursive($val);

        $this->assertIsArray($add);
        $this->assertTrue(count($add) == $val + 1);
        $this->assertEquals('integer', isArrayOf($add));
      });
  }
}
