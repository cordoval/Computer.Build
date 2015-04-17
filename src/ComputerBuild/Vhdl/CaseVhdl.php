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
        $out->print($prefix."CASE ".$this->input." IS");
        foreach ($this->conditions as $conditionPair) {
            list($condition, $expression) = $conditionPair;
            $out->print($prefix."  WHEN ");
            if (preg_match('/^\d$/', $condition)) {
                $out->print("'".$condition."'");
            } elseif (preg_match('/^\d+$/', $condition)) {
                $out->print("\"".$condition."\"");
            } else {
                $out->print($condition);
            }
            $out->print(" =>");
            if ($expression instanceof InlineStatement) {
                $out->print($expression->generate());
            } else {
                $out->print($expression->generate($out, $indent+1));
            }
        }
        $out->print($prefix."END CASE;");
    }
}