<?php

namespace ComputerBuild\Vhdl;

class SingleLineStatement extends Statement
{
    public function __construct()
    {
	//
    }

    /**
     * @inherit
     */
    public function generate($out, $indent)
    {
        for ($i = 0; $i <= $indent; $i++) {
            $out->print("  ");
        }
        $out->print(parent::line());
        $out->print("\n");
    }
}
