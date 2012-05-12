<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Assignment;
use ComputerBuild\Vhdl\StatementTrait;

class StatementTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testStdLogicVectorFromRangeToFormattedString()
    {
        $stdLogicVectorString = new Test1();
        $callAsc = $stdLogicVectorString->stdLogicVector(range(0,7));
        $callDesc = $stdLogicVectorString->stdLogicVector(range(7,0));
        $outputStringAsc = "STD_LOGIC_VECTOR(0 upto 7)";
        $outputStringDesc = "STD_LOGIC_VECTOR(7 downto 0)";
        $this->assertEquals($outputStringAsc, $callAsc);
        $this->assertEquals($outputStringDesc, $callDesc);
    }
}

class Test1
{
    use StatementTrait;
}