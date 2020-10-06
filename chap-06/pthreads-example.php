<?php

require __DIR__ . '/fibGenerate.php';

class ExecFunc extends Thread
{
  private \Closure $method;

  private $params;

  private $result;

  private $joined;

  public function __construct(callable $func, ...$params)
  {
    $this->method = $func;
    $this->params = $params;
    $this->result = null;
    $this->joined = false;
  }

  public function run()
  {
    $this->result = ($this->method)(...$this->params);
  }

  public static function call(callable $func, ...$params)
  {
    $thread = new static($func, ...$params);
    if ($thread->start()) {
      return $thread;
    }
  }

  public function __toString()
  {
    if (!$this->joined) {
      $this->joined = true;
      $this->join();
    }

    return $this->result;
  }
};

$a = ExecFunc::call('fibGenerate', 1, 10);

$b = ExecFunc::call('fibGenerate', 11, 20);
