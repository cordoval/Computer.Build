<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Assignment;

class AssignmentTest extends \PHPUnit_Framework_TestCase
{
    public function testAssignmentShouldAddSemicolon()
    {
        $assignment = new Assignment(array('output', '0101001'));
        $this->assertEquals("output <= \"0101001\";", $assignment->line());
    }
}