<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Fixnum;

class FixnumTest extends \PHPUnit_Framework_TestCase
{
    public function testFixnumShouldConvert777toBinary()
    {
        $fixNum = new Fixnum(777);
        $this->assertEquals(1100001001, (string) $fixNum);
    }
}