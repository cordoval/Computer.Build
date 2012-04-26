<?php

namespace ComputerBuild\Vhdl;

class Equal extends InlineStatement
{
    protected $target;
    protected $expression;

    public function __construct($target, $expression)
    {
        $this->target = $target;
        $this->expression = $expression;
    }

    public function generate()
    {
        return $this->target." = ".$this->quoted($this->expression);
    }
}
