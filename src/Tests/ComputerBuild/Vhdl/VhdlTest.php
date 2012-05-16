<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Vhdl;

class VhdlTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldGenerateWholeSheBang()
    {
        $vhdl = new Vhdl(new Entity());
        $expectedOutput = <<<EOF
LIBRARY ieee;
USE ieee.std_logic_1164.all;
USE ieee.numeric_std.all;
EntityPlaceholder
EOF;
        $this->assertEquals($expectedOutput, $vhdl->generate());
    }
}

class Entity
{
    public function __construct()
    {

    }

    public function generate()
    {
        return "EntityPlaceholder";
    }
}