<?php

namespace ComputerBuild\Vhdl;

use ComputerBuild\Filesystem\GeneratedOutput;

/**
 * Class to render single line statement
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
abstract class SingleLineStatement extends AbstractStatement
{
    public function generate(GeneratedOutput $out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $out->printLine($prefix);
        $out->printLine($this->line());
        $out->printLine("\n");
    }

    abstract function line();
}
