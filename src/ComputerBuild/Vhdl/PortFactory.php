<?php

namespace ComputerBuild\Vhdl;

class PortFactory
{
    const DIRECTION_IN = 0;
    const DIRECTION_OUT = 1;
    const DIRECTION_INOUT = 2;

    public static function getInstance()
    {
        return new PortFactory();
    }

    public function create($direction, $number, $label)
    {
        $ports = array();
        $description = "some default description";

        if ($number == 1) {
            return new Port($label, $direction, $description);
        }

        for ($i = 1; $i <= $number; $i++) {
            $increment = $i;
            $ports[] = new Port($label.$increment, $direction, $description);
        }

        return $ports;
    }
}