<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Assign;

class AssignTest extends \PHPUnit_Framework_TestCase
{
    public function testAssignTwoArgumentsShouldAssignFirstTargetSecondExpression()
    {
        // Assign(arg0, arg1)
        // arg0 <= std_logic_vector("arg1")
        $assignStatement = new Assign(array('output', '0101001'));
        $this->assertEquals("output <= \"0101001\"", $assignStatement->generate());
    }

    public function testAssignFourArgumentsShouldSplitTwoAssignments()
    {
        // Assign(arg0, arg1, arg2, arg3)
        // output(7 downto 0) <= std_logic_vector("00010001")
        $assignStatement = new Assign(array('output', '7 downto 0', 'std_logic_vector', '00010001'));
        $this->assertEquals("output(7 downto 0) <= std_logic_vector(\"00010001\")", $assignStatement->generate());
    }

}