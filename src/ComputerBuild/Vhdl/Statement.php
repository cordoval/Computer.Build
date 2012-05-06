<?php

namespace ComputerBuild\Vhdl;

/**
 * Base statement class
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Statement
{
    /**
     * quotes a vhdl expression
     * @param $expression
     * @return mixed
     */
    public function quoted($expression)
    {
        if (is_string($expression)) {
            if (strlen($expression) == 1) {
                return "'".$expression."'";
            } else {
                return "\"".$expression."\"";
            }
        } elseif ($expression instanceof Fixnum) {
                return "std_logic_vector(\"".$expression."\")";
        } else {
            return $expression;
        }
    }
}
