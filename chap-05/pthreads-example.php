<?php

require 'fibonacci.php';

$fnCaller = new class extends Thread {
    private $method;

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

$rangeA = $fnCaller::call(fibGenerate, 1, 10);

$rangeB = $fnCaller::call(fibGenerate, 11, 20);