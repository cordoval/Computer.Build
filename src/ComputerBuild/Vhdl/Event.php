<?php

namespace ComputerBuild\Vhdl;

/**
 * Class to inline $target'EVENT
 * $target is the signal
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Event extends InlineStatement
{
    protected $target;

    public function __construct($target)
    {
        $this->target = $target;
    }

    public function generate()
    {
        return $this->target."'EVENT";
    }
}
