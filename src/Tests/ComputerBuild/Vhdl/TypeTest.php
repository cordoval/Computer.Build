<?php

namespace Tests\ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Type;

/**
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Raul Rodriguez <raulrodriguez782@gmail.com>
 */
class TypeTest extends \PHPUnit_Framework_TestCase
{
    public function testTypeStatement()
    {
        $typeStatement = new Type('type_enum', array('a', 'b', 'c'));
        $this->assertEquals('TYPE type_enum IS (a, b, c);', $typeStatement->line());
    }
}