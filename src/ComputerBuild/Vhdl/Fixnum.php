<?php

namespace ComputerBuild\Vhdl;

class Fixnum
{
    public function toLogic($width)
    {
        $str = $this->toString(2);
        $times = $width - strlen($str);
        $zeros = str_pad('', $times, 0);
        return $zeros.$str;
    }
}
