<?php

namespace ComputerBuild\Vhdl;

class Behavior
{
    use StatementTrait;

    protected $statements;

    public function __construct($body)
    {
        $this->statements = array();
        $body->call($this);
    }

    public function process($inputs, $body)
    {
        return $this->statements[] = new Process($inputs, $body);
    }

    public function instance($args = null)
    {
        return $this->statements[] = new Instance($args = null);
    }
}