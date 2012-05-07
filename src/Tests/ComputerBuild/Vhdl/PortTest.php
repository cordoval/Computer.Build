<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Port;
use ComputerBuild\Filesystem\GeneratedOutput;

class PortTest extends \PHPUnit_Framework_TestCase
{
    public function testPortShouldOutputGeneratedConstructIsLast()
    {
        $out = new GeneratedOutput(GeneratedOutput::STD_OUT);
        $port = new Port('signalReset', 'in', 'std_logic_vector(7 downto 0)');
        $this->assertEquals("PORT signalReset: in std_logic_vector(7 downto 0)", $port->generate($out, 0, true));
    }

    public function testPortShouldOutputGeneratedConstructIsNotLast()
    {
        $out = new GeneratedOutput(GeneratedOutput::STD_OUT);
        $port = new Port('signalReset', 'in', 'std_logic_vector(7 downto 0)');
        $this->assertEquals("PORT signalReset: in std_logic_vector(7 downto 0);", $port->generate($out, 0, false));
    }
}