<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Process;
use ComputerBuild\Vhdl\Statement;
use ComputerBuild\Filesystem\GeneratedOutput;
use ComputerBuild\Vhdl\Assignment;
use ComputerBuild\Vhdl\Symbol;

class ProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessBlock()
    {
        $inputs = array(
            new Symbol('i1'),
            new Symbol('i2'),
            new Symbol('i3'),
            new Symbol('o1'),
        );

        ob_start();
        $processBlock = new Process($inputs);
        $firstStatement = new Assignment(array('sig1', '0'));
        $secondStatement = new Assignment(array('sig2', '1'));
        $processBlock->setStatements(array($firstStatement, $secondStatement));
        $expectedOutput = <<<EOF
PROCESS(i1, i2, i3, o1)
BEGIN
 sig1 <= '0';
 sig2 <= '1';
END PROCESS;\n
EOF;
       $out = new GeneratedOutput();
       $processBlock->generate($out, 0);
       $actualOutput = ob_get_contents();
       ob_clean();
       $this->assertEquals($expectedOutput, $actualOutput);
    }
}
