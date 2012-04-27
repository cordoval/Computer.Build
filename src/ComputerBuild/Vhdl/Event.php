<?php

namespace ComputerBuild\Vhdl;

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
