<?php

namespace ComputerBuild\Vhdl;

/**
 * Class to render signal statement
 *
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Raul Rodriguez <raulrodriguez782@gmail.com>
 */
class Signal extends SingleLineStatement
{
    protected $id;
    protected $type;

    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function generate()
    {
        return "SIGNAL ".$this->id." : ".$this->type.";";
    }
}
