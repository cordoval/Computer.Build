<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Event;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testEventShouldReturnclk1Event()
    {
        $event = new Event("clk1");
        $this->assertEquals("clk1'EVENT", $event->generate());
    }
}