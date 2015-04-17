<?php

namespace ComputerBuild\Vhdl;

class Vhdl
{
    public function generate_vhdl($entity, $out)
    {
        $out->print("LIBRARY ieee;");
        $out->print("USE ieee.std_logic_1164.all;");
        $out->print("USE ieee.numeric_std.all;");
        $entity->generate($out);
    }
}
