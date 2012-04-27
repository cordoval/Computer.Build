<?php

namespace ComputerBuild\Vhdl;

class Invert extends InlineStatement
{
    protected $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

    public function generate()
    {
        return "NOT (".$this->body.")";
    }
}
