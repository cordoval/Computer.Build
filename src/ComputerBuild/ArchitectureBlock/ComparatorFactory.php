<?php

namespace ComputerBuild\ArchitectureBlock;

/**
* ComparatorFactory class
*/
class ComparatorFactory
{
    public function create()
    {
        return new Comparator();
    }
}