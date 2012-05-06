<?php

namespace ComputerBuild\Vhdl;

/**
 * Symbol
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Symbol
{
    protected $expression;

    public function __construct($expression)
    {
        $this->expression = $expression;
    }

    public function __toString()
    {
        return $this->expression;
    }
}
