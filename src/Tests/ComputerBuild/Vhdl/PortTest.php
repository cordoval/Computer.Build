<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Port;
use ComputerBuild\Filesystem\GeneratedOutput;

class PortTest extends \PHPUnit_Framework_TestCase
{
    public function testPortShouldOutputGeneratedConstructIsLast()
    {
        $port = new Port('signalReset', 'in', 'std_logic_vector(7 downto 0)');
        $this->assertEquals("signalReset: in std_logic_vector(7 downto 0)", $port->generate(0, true));
    }

    public function testPortShouldOutputGeneratedConstructIsNotLast()
    {
        $port = new Port('signalReset', 'in', 'std_logic_vector(7 downto 0)');
        $this->assertEquals("signalReset: in std_logic_vector(7 downto 0);", $port->generate(0, false));
    }
}