<?php

namespace ComputerBuild\Vhdl;

class Entity
{
    public function __construct($name, $body)
    {
        $this->name = $name;
        $this->ports = array();
        $this->signals = array();
        $this->types = array();
        $this->components = array();
        $body[$this];
    }

    public function port($args)
    {
        $this->ports[] = new Port($args);
    }

    public function signal($args)
    {
        $this->signals[] = new Signal($args);
    }

    public function behavior($body)
    {
        $this->behavior = new Behavior($body);
    }

    public function type($args)
    {
        $this->types[] = new Type($args);
    }

    public function component($args, $body)
    {
        $this->components[] = new Component($args, $body);
    }

    public function generate($out)
    {
        $out->print("ENTITY ".$this->name." IS");
        $out->print("PORT(");
        foreach ($this->ports as $index => $port) {
            $port->generate($out, 1, ($index == sizeof($this->ports)));
        }
        $out->print(");");
        $out->print("END ".$this->name.";");
        $out->print("ARCHITECTURE arch_".$this->name." OF ".$this->name." IS");
        foreach ($this->types as $index => $type) {
            $type->generate($out, 1);
        }
        foreach ($this->signals as $index => $signal) {
            $signal->generate($out, 1);
        }
        foreach ($this->components as $index => $component) {
            $component->generate($out, 1);
        }
        $out->print("BEGIN");
        $this->behavior()->generate($out,1);
        $out->print("END arch_".$this->name.";");
    }

}