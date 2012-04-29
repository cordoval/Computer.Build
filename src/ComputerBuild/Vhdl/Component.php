<?php

namespace ComputerBuild\Vhdl;

class Component extends MultiLineStatement
{
    protected $name;
    protected $ports;

    public function __construct($name, $injectedBlock)
    {
        $this->name = $name;
        $this->ports = array();
        $injectedBlock->setThis($this);
    }

    public function in($name, $type)
    {
        $this->ports[] = new Port($name, "in", $type);
    }

    public function out($name, $type)
    {
        $this->ports[] = new Port($name, "out", $type);
    }

    public function inout($name, $type)
    {
        $this->ports[] = new Port($name, "inout", $type);
    }

    public function generate($out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $out->print($prefix."COMPONENT ".$this->name);
        $out->print($prefix."PORT(");
        foreach ($this->ports as $index => $port) {
            $port->generate($out, $indent+1, ($index == sizeof($this->ports)-1));
        }
        $out->print($prefix.");");
        $out->print($prefix."END COMPONENT;");
    }
}