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

    public function generate($out = $stdout)
    {
        $out->print("ENTITY ".$this->name." IS");
    }
}