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

    public function generate($out, $indent, $last)
    {
        for ($i = 0; $i <= $indent; $i++) {
            $out->print("  ");
        }
        $out->print($this->id.": ".$this->direction." ".$this->description);
        $out->print($last ? "": ";");
    }
}
