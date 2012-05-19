<?php

namespace ComputerBuild\Vhdl;

class CaseVhdl
{
    protected $input;
    protected $body;

    public function __construct($input)
    {
        $this->input = $input;
        $this->conditions = array();
    }

    public function setCondition($condition)
    {
        $this->conditions[] = $condition;
    }

    public function getConditions()
    {
        return $this->conditions;
    }

    public function generate($indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $output = $prefix."CASE ".$this->input." IS";
        foreach ($this->conditions as $conditionPair) {
            list($condition, $expression) = $conditionPair;
            $output .= $prefix."  WHEN ";
            if (preg_match('/^\d$/', $condition)) {
                $output .= "'".$condition."'";
            } elseif (preg_match('/^\d+$/', $condition)) {
                $output .= "\"".$condition."\"";
            } else {
                $output .= $condition;
            }
            $out .= " =>";
            if ($expression instanceof InlineStatement) {
                $out .= $expression->generate();
            } else {
                $expression->generate($indent+1);
            }
        }
        $prefix."END CASE;";
    }
}