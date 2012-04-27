<?php

namespace ComputerBuild\Vhdl;

/**
 * Statement class
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Statement
{
    /**
     * quotes a vhdl string
     * @param $expression
     * @return string
     */
    public function quoted($expression)
    {
        if ($expression instanceof \string) {
            if (strlen($expression) == 1) {
                return "'$expression'";
            } else {
                return "\"".$expression."\"";
            }
        } elseif ($expression instanceof Fixnum) {
                return "std_logic_vector(".$expression.")";
        } else {
            return $expression;
        }
    }
}
