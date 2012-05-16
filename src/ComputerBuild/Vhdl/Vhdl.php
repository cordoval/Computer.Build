<?php

namespace ComputerBuild\Vhdl;

class Vhdl
{
    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function generate()
    {
        return "LIBRARY ieee;\n"."USE ieee.std_logic_1164.all;\n"."USE ieee.numeric_std.all;\n".$this->entity->generate();
    }
}
