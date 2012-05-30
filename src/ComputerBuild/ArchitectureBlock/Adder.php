<?php

namespace ComputerBuild\ArchitectureBlock;

/**
 * Adder Class
 */
class Adder implements AdderInterface
{
  public function add($a, $b)
  {
    return $a + $b;
  }
}

