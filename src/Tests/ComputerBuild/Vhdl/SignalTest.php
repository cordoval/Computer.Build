<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Signal;

class SignalTest extends \PHPUnit_Framework_TestCase
{
    public function testSignalStatement()
    {
        $signalStatement = new Signal('wire1', 'std_logic');
        $this->assertEquals("SIGNAL wire1 : std_logic;", $signalStatement->generate());
    }
}