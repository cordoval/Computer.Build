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
        $prefix = str_pad('', $indent, "  ");
        $out->printLine($prefix);
        $out->printLine($this->id.": ".$this->direction." ".$this->description);
        $out->printLine($last ? "": ";");
    }

    public function line()
    {
        return true;
    }
}
