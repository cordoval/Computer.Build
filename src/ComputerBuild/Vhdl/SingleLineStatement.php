<?php

namespace ComputerBuild\Vhdl;

/**
 * Class to render single line statement
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
abstract class SingleLineStatement extends AbstractStatement
{
    public function generate($out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $out->print($prefix);
        $out->print($this->line());
        $out->print("\n");
    }

    abstract function line();
}
