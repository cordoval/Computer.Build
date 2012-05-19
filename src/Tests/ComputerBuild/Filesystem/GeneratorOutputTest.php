<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Filesystem\GeneratedOutput;
use ComputerBuild\Vhdl\Equal;

class GeneratedOutputTest extends \PHPUnit_Framework_TestCase
{
    public function xtestShouldGenerateOutputOnStdOut()
    {
        // setup generation
        $equalObject = new Equal('signal22', '0');

        ob_start();
        // setup file/stream
        $out = new GeneratedOutput();
        $equalObject->generate($out);
        $expectedOutput = "signal22 = '0'";
        $actualOutput = ob_get_contents();
        ob_end_clean();

        // assert it works!
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    public function testShouldGenerateOutputOnFile()
    {
        $this->markTestIncomplete('here we will create a file');
    }
}