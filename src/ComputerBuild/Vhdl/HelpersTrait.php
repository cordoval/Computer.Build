<?php

trait HelpersTrait
{
    public function entity($name, $body)
    {
        return new Entity($name, $body);
    }

    public function assign($target, $expression)
    {
        return new Assign($target, $expression);
    }

    public function high($target)
    {
        return $this->assign($target, '1');
    }

    public function low($target)
    {
        return $this->assign($target, '0');
    }

    public function equal($target, $expression)
    {
        return new Equal($target, $expression);
    }

    public function event($target)
    {
        return new Event($target);
    }

    public function block($body)
    {
        return new Block($body);
    }

    public function subbits($sym, $range)
    {
        return $sym."(".$range->first()." downto ".$range->last().")";
    }

    public function invert($body)
    {
        return new Invert($body);
    }
}