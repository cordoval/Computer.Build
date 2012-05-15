<?php

namespace ComputerBuild\Vhdl;

class Instance extends SingleLineStatement
{
    protected $component;
    protected $name;
    protected $ports;

    public function __construct($component, $name, $ports)
    {
        $this->component = $component;
        $this->name = $name;
        $this->ports = $ports;
    }

    public function line()
    {
    }

    public function generate()
    {
        $concatenatedPorts = implode(",", $this->ports);
        return $this->name.": ".$this->component." PORT MAP(".$concatenatedPorts.");";
    }
}
