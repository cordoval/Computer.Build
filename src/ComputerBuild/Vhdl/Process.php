<?php

namespace ComputerBuild\Vhdl;

class Process
{
use StatementTrait;

    protected $statements;
    protected $inputs;

    public function __construct($inputs, $body)
    {
        $this->inputs = $inputs;
        $this->statements = array();
        $body[$this];
    }

    public function generate($out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $args = $this->inputs->map(&:to_s).join(',');
        $out->print($prefix."PROCESS(".$args.")");
        $out->print($prefix."BEGIN");
        //$this->statements.each {|s| s.generate(out, indent + 1)}
        $out->print($prefix."END PROCESS;");
    }
}