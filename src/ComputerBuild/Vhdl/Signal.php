<?php

namespace ComputerBuild\Vhdl;

class Signal extends SingleLineStatement
{
    protected $id;
    protected $type;

    public function initialize($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function line()
    {
        return "SIGNAL ".$this->id." : ".$this->type.";";
    }
}
