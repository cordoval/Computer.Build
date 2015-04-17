<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Equal;
use ComputerBuild\Filesystem\GeneratedOutput;

class EqualTest extends \PHPUnit_Framework_TestCase
{
    public function testEqualShouldReturnFormattedString()
    {
        $equalStatement = new Equal('signal22', '0');
        $expectedString = "signal22 = '0'";
        $actualOutput = $equalStatement->generate();
        $this->assertEquals($expectedString, $actualOutput);
    }
}