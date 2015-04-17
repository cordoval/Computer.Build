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

    public function generate(GeneratedOutput $out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
	$serializedInputs = array_map(function($input) { return $input->__toString(); }, $this->inputs);
        $args = implode(", ", $serializedInputs);
        $out->printLine($prefix."PROCESS(".$args.")");
        $out->printLine($prefix."BEGIN");
        foreach ($this->statements as $statement) {
            $statement->generate($out, $indent+1);
        }
        $out->printLine($prefix."END PROCESS;");
    }
}
