<?php

function throwSomeException()
{
    throw new Exception('I am an exception');
}

function add(int $valX) 
{
    $valY = throwSomeException();

    try {
        $result = $valX + $valY;
    } catch (Exception $exception) {
        $result = 30;
    }

    return $result;
}

add(12);