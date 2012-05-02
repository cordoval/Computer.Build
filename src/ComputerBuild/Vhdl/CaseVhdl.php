<?php

namespace ComputerBuild\Vhdl;

class CaseVhdl
{
    protected $input;
    protected $body;

    public function __construct($input, $body)
    {
        $this->input = $input;
        $this->conditions = array();
        $body->call($this->conditions);
    }

    public function generate($out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $out->print($prefix."CASE ".$input." IS");
        foreach ($this->conditions as $condition) {
            $condition = ;
        }
        $out->print($prefix." WHEN ");
        if ($condition) {

        }
    }
}