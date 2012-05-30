<?php

namespace ComputerBuild\Vhdl;

use ComputerBuild\Filesystem\GeneratedOutput;

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

    public function generate()
    {
    	$serializedInputs = array_map(function($input) { return $input->__toString(); }, $this->inputs);
        $args = implode(", ", $serializedInputs);
        $out = "PROCESS(".$args.")\n";
        $prefix = " ";
        $out .= "BEGIN\n";
        foreach ($this->statements as $statement) {
            $out .= $prefix.$statement->generate()."\n";
        }
        $out .= "END PROCESS;\n";
	return $out;
    }
}
