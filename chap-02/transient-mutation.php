<?php

require __DIR__ . '/vendor/autoload.php';

use Chemem\Bingo\Functional\Common\Traits\TransientMutator;

class Money
{
  use TransientMutator;

  private float $value;

  public function __construct(float $value)
  {
    $this->value = $value;
  }

  public function add(Money $money): Money
  {
    return $this->update($money->value + $this->value);
  }

  private function update(float $value): Money
  {
    if ($this->isMutable()) {
      $this->value = $value;

      return $this;
    }

    return new static($value);
  }

  public static function sum(Money ...$monies): Money
  {
    return array_shift($monies)
			->triggerMutation(function (Money $obj) use ($monies) {
			  foreach ($monies as $money) {
			    $obj->add($money);
			  }

			  return $obj;
			});
  }

  public function getWallet(): float
  {
    return $this->value;
  }
}
