<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Statement;

class StatementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldQuoteStringLengthOfOne()
    {
        $this->assertEquals("'u'", (new Statement())->quoted('u'));
    }
}
