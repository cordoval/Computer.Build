<?php

namespace ComputerBuild\Vhdl;

/**
 * Behavior of entity
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Behavior
{
    use StatementTrait;

    protected $statements;

    public function __construct()
    {
        $this->statements = array();
    }

    public function addProcess($inputs)
    {
        return $this->statements[] = new Process($inputs);
    }

    public function addInstance($component, $name, $ports)
    {
        return $this->statements[] = new Instance($component, $name, $ports);
    }
}