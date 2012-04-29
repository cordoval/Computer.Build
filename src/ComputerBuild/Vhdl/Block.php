<?php

namespace ComputerBuild\Vhdl;

class Block extends MultiLineStatement
{
    use StatementBlock;

    protected $statements;

    public function __construct($body)
    {
        $this->statements = array();
        $body->call($this);
    }

}