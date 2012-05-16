<?php

namespace ComputerBuild\Vhdl;

class Port extends SingleLineStatement
{
    protected $id;
    protected $direction;
    protected $description;

    public function __construct($id, $direction, $description)
    {
        $this->id = $id;
        $this->direction = $direction;
        $this->description = $description;
    }

    public function generate($indent, $last)
    {
        $prefix = str_pad('', $indent, "  ");
        $semiColonOrNull = $last ? "": ";";
        return $prefix.$this->id.": ".$this->direction." ".$this->description.$semiColonOrNull;
    }

    public function line()
    {
        return true;
    }
}
