<?php

namespace ComputerBuild\ArchitectureBlock;

class FactoryAdder
{
    public static function getInstance()
    {
        return new FactoryAdder();
    }

    public function create()
    {
        return new Adder();
    }
}
