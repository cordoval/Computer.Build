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

    public function generate()
    {
        return $this->id.": ".$this->direction." ".$this->description;
    }
}
