<?php

namespace ComputerBuild\Vhdl;

/**
 * Class to render single line statement
 *
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Raul Rodriguez <raulrodriguez782@gmail.com>
 */
class Type extends SingleLineStatement
{
    protected $name;
    protected $values;

    public function __construct($name, array $values)
    {
        $this->name = $name;
        $this->values = $values;
    }

    public function generate()
    {
        return "TYPE ".$this->name." IS (".implode(', ', $this->values).");";
    }
}
