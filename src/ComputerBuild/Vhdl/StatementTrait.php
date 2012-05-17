<?php

namespace ComputerBuild\Vhdl;

/**
 * Trait methods
 *
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Danny Montalvo <danny.montalvo@gmail.com>
 */
trait StatementTrait
{
    protected $statements;

    public function caseVhdl($input, $body)
    {
        return $this->statements[] = new CaseVhdl($input, $body);
    }

    public function ifVhdl($conditions, $body)
    {
        $ifThenElse = new IfVhdl($conditions, $body);
        $this->statements[] = $ifThenElse;
        return $ifThenElse;
    }

    public function assign($args = null)
    {
        return $this->statements[] = new Assignment($args = null);
    }

    public function high($target)
    {
        return new Assign($target, 1);
    }

    public function low($target)
    {
        return new Assign($target, 0);
    }

    public function generate($indent)
    {
        $output = "";
        foreach($this->statements as $statement) {
            $output .= $statement->generate($indent);
        }
        return $output;
    }

    /**
     * std_logic_vector method
     *
     * @param $range array(top = integer, bottom = 0)
     * @return string
     */
    public function stdLogicVector($range)
    {
        $first = $range[0];
        $last = $range[sizeof($range) - 1];
        // e.g.: array(7,0)
        // STD_LOGIC_VECTOR(0 upto 7);
        // STD_LOGIC_VECTOR(7 downto 0);
        if ($first > $last) {
            return "STD_LOGIC_VECTOR(".$first." downto ".$last.")";
        } else {
            return "STD_LOGIC_VECTOR(".$first." upto ".$last.")";
        }
    }
}