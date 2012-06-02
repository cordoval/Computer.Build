<?php

namespace ComputerBuild\ArchitectureBlock;

class AdderFactory
{
    public static function getInstance()
    {
        return new AdderFactory();
    }

    public function create()
    {
        return new Adder();
    }
}