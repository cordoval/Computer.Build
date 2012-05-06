<?php

namespace ComputerBuild\Vhdl;

class Process
{
use StatementTrait;

    protected $statements;
    protected $inputs;

    public function __construct($inputs)
    {
        $this->inputs = $inputs;
        $this->statements = array();
    }

    public function setStatements($statements)
    {
        $this->statements = $statements;
    }

    public function addStatement($statement)
    {
        $this->statements[] = $statement;
    }

    public function generate($out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $args = implode(', ', array_map('__toString', $this->inputs));
        $out->print($prefix."PROCESS(".$args.")");
        $out->print($prefix."BEGIN");
        foreach ($this->statements as $statement) {
            $statement->generate($out, $indent+1);
        }
        $out->print($prefix."END PROCESS;");
    }
}
