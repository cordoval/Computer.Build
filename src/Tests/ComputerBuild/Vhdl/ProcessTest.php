<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Process;
use ComputerBuild\Vhdl\Statement;
use ComputerBuild\Filesystem\GeneratedOutput;
use ComputerBuild\Vhdl\Assignment;

class ProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessBlock()
    {
        $this->markTestIncomplete('pending');

        $processBlock = new Process(array('i1', 'i2', 'i3', 'o1'));
        $firstStatement = new Assignment(array('sig1', '0'));
        $secondStatement = new Assignment(array('sig2', '1'));
        $processBlock->setStatements(array($firstStatement, $secondStatement));
        $expectedOutput = <<<EOF
PROCESS (
    i1: std_logic;
    i2: std_logic;
    i3: std_logic;
    o1: std_logic;
)
BEGIN
    sig1 <= '0';
    sig2 <= '1';
END PROCESS
EOF;
       $out = new GeneratedOutput('example.vhd', __DIR__."/sandbox/");
       $this->assertEquals($expectedOutput, $processBlock->generate($out,0));
    }
}