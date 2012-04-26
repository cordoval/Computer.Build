<?php

namespace ComputerBuild\Vhdl;

class Statement
{
    public function quoted($expression)
    {
        if ($expression instanceof \string) {
            if (strlen($expression) == 1) {
                return "'$expression'";
            } else {
                return "\"".$expression."\"";
            }
        } elseif ($expression instanceof \int) {
                return "std_logic_vector(".$expression.")";
        } else {
            return $expression;
        }
    }
}
