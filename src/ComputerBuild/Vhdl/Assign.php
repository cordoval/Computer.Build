<?php

namespace ComputerBuild\Vhdl;

use ComputerBuild\Vhdl\Symbol;

/**
 * Assigns
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Assign extends InlineStatement
{
    protected $args;

    /**
     * @param array $args | size should be 2 or 4
     */
    public function __construct(array $args)
    {
        if (sizeof($args) == 2) {
            $this->target = $args[0];
            $this->expression = $args[1];
        } else {
            $this->target = $args[0]."(".$args[1].")";
            $this->expression = $args[2]."(\"".$args[3]."\")";
            $this->expression = new Symbol($this->expression);
        }
    }

    public function generate()
    {
        return $this->target." <= ".$this->quoted($this->expression);
    }
}
