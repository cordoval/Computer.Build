<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Behavior;

class BehaviorTest extends \PHPUnit_Framework_TestCase
{
    public function testBehaviorShouldGenerateBehaviorBlock()
    {
        $behavior = new Behavior();
        $behavior->addInstance('alu', 'U23', array('a1,a2,a3'));
        $this->assertEquals("U23: alu PORT MAP(a1,a2,a3);", $behavior->generate(0));
    }
}