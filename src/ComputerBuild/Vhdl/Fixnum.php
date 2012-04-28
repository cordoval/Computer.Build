<?php

namespace ComputerBuild\Vhdl;

class Fixnum
{
    protected $number;
    protected $binary;

    public function __construct($number)
    {
        $this->number = $number;
        $this->binary = null;
    }

    public function toBase($base)
    {
        return $this->binary = base_convert($this->number, 10, $base);
    }

    public function toLogic($width)
    {
        $str = $this->toBase(2);
        $times = $width - strlen($str);
        $zeros = str_pad('', $times, 0);
        return $zeros.$str;
    }

    public function __toString()
    {
        return $this->toLogic(8);
    }
}
