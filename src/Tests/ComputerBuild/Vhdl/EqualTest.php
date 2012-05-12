<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Equal;
use ComputerBuild\Filesystem\GeneratedOutput;

class EqualTest extends \PHPUnit_Framework_TestCase
{
    public function testEqualShouldReturnFormattedString()
    {
        ob_start();
        $equalStatement = new Equal('signal22', '0');
        $expectedString = "signal22 = '0'";
        $out = new GeneratedOutput();
        $equalStatement->generate($out);
        $actualOutput = ob_get_contents();
        ob_end_clean();
        $this->assertEquals($expectedString, $actualOutput);
    }
}