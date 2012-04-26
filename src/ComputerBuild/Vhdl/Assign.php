<?php

namespace ComputerBuild\Vhdl;

class Assign extends InlineStatement
{
    protected $args;

    public function __construct($args = null)
    {
        if (strlen($args) == 2) {
            $this->target = $args[0];
            $this->expression = $args[1];
        } else {
            $this->target = $args[0]."(".$args[1].")";
            $this->expression = $args[2]."(".$args[3].")";
            $this->expression .= $this->expression->toSymbol();
        }
    }

    public function generate()
    {
        return $this->target." <= ".$this->quoted($this->expression);
    }
}
