<?php

namespace ComputerBuild\Vhdl;

class SingleLineStatement extends Statement
{
    public function generate($out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $out->print($prefix);
        $out->print($this->line());
        $out->print("\n");
    }
}
