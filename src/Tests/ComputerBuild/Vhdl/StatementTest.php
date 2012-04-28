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
        $this->assertEquals("std_logic_vector(\"00000101\")", (new Statement())->quoted(new Fixnum(5)));
    }

    public function testItShouldReturnTheSameExpressionIfNoneOfTheAbove()
    {
        $expression = new AnotherTestClass();
        $this->assertEquals($expression, (new Statement())->quoted($expression));
    }

    public function testItShouldTestForInteger()
    {
        $this->assertEquals(77, (new Statement())->quoted(77));
        $this->assertEquals("\"77\"", (new Statement())->quoted("77"));
    }
}

class AnotherTestClass
{

}