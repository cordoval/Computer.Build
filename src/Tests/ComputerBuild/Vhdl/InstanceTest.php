<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Instance;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceShouldMatch()
    {
        $instance = new Instance("SpecialComponent","U23",array("A1", "A2", "A3"));
        $this->assertEquals("U23: SpecialComponent PORT MAP(A1,A2,A3);", $instance->generate());
    }
}
