<?php

namespace ComputerBuild\ArchitectureBlock;

/**
 * Comparator
 */
class Comparator implements ComparatorInterface
{
    public function compare($a, $b)
    {
        if ($a >= $b) {
            return true;
        } else {
            return false;
        }
    }
}