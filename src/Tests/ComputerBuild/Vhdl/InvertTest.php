<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Invert;

class InvertTest extends \PHPUnit_Framework_TestCase
{
    public function testInlineInvert()
    {
        $invert = new Invert('input');
        $this->assertEquals("NOT (input)", $invert->generate());
    }
}