<?php

namespace ComputerBuild\Vhdl;

/**
 * Class Block gathers statements in an array
 *
 * @author Luis Cordova <cordoval@gmail.com>
 * @author Randiel Melgarejo <randielmelgarejo@gmail.com>
 */
class Block extends MultiLineStatement
{
    use StatementBlock;

    protected $statements;

    public function __construct()
    {
        $this->statements = array();
    }

    public function setStatements($statements)
    {
        $this->statements = $statements;
    }

    public function getStatements($statements)
    {
        return $this->statements;
    }

    public function addStatement($statement)
    {
        $this->statements[] = $statement;
    }
}