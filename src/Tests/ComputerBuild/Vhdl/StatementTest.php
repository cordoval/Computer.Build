<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Statement;
use ComputerBuild\Vhdl\Fixnum;

class StatementTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldQuoteStringLengthOfOne()
    {
        $this->assertEquals("'u'", (new Statement())->quoted('u'));
    }

    public function testItShouldQuoteStringLengthOfTwo()
    {
        $this->assertEquals("\"xy\"", (new Statement())->quoted("xy"));
    }

    public function testItShouldWrapStdLogicVector()
    {
        $expression = new Fixnum(5);
        $this->assertEquals("std_logic_vector(\"00000101\")", (new Statement())->quoted($expression));
    }

    public function testItShouldReturnTheSameExpressionIfNoneOfTheAbove()
    {
        $expression = new AnotherTestClass();
        $this->assertEquals($expression, (new Statement())->quoted($expression));
    }
}

class AnotherTestClass
{

}