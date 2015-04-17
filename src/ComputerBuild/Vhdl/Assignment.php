<?php

namespace ComputerBuild\Vhdl;

class Assignment extends SingleLineStatement
{
    protected $assign;

    public function __construct($args)
    {
        $this->assign = new Assign($args);
    }

    public function line()
    {
        return $this->assign->generate().";";
    }
}
