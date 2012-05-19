<?php

namespace ComputerBuild\Vhdl;

/**
 * Transition Class
 *
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Reece Fowell <reece@codeconsortium.com>
 */
class Transition
{
    protected $from;
    protected $to;
    protected $condition;

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function __construct($option)
    {
        $this->from = $option['from'];
        $this->to = $option['to'];
        $this->condition = $option['condition'] || $option['on'];
    }
}
