<?php

function addTen(int $val)
{
  if ($val > 20) {
    return $val + 10;
  } 
}

var_dump(addTen(12));

var_dump(addTen(30));
