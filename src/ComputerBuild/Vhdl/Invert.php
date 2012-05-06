<?php

namespace ComputerBuild\Vhdl;

/**
 * Class to inline a NOT ($body)
 * $body is argument to be negated
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Invert extends InlineStatement
{
    protected $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

    public function generate()
    {
        return "NOT (".$this->body.")";
    }
}
