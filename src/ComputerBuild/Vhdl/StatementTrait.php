<?php

namespace ComputerBuild\Vhdl;

trait StatementTrait
{
    protected $statements;

    public function caseVhdl($input, $body)
    {
        return $this->statements[] = new CaseVhdl($input, $body);
    }

    public function ifVhdl($conditions, $body)
    {
        $ifThenElse = new IfVhdl($conditions, $body);
        $this->statements[] = $ifThenElse;
        return $ifThenElse;
    }

    public function assign($args = null)
    {
        return $this->statements[] = new Assignment($args = null);
    }

    public function high($target)
    {
        return new Assign($target, 1);
    }

    public function low($target)
    {
        return new Assign($target, 0);
    }

    public function generate($out, $indent)
    {
        //$this->statements
        //@statements.each {|s| s.generate(out, indent + 1)}
    }
}