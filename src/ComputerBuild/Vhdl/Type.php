<?php

namespace ComputerBuild\Vhdl;

class Type extends SingleLineStatement
{
    protected $name;
    protected $values;

    public function initialize($name, $values)
    {
        $this->name = $name;
        $this->values = $values;
    }

    public function line()
    {
        $valuesSeparatedWithComas = "";
        foreach ($this->values as $key => $value) {
            $separator = $last ? ", " : "";
            $valuesSeparatedWithComas .= $this->values[$key].$separator;
        }

        return "TYPE ".$this->name." IS ( ".$valuesSeparatedWithComas." );";
    }
}
