<?php

namespace ComputerBuild\Vhdl;

/**
 * If VHDL statement class
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class IfVhdl extends MultiLineStatement
{
    use StatementTrait;

    protected $conditions;
    protected $compound;
    protected $statements;

    public function __construct($conditions, $body)
    {
        $this->conditions = $conditions;
        $this->compound = false;
        $this->statements = array();
        $body[$this];
    }

    public function elsifVhdl($conditions, $body)
    {
        if ($this->compound) {
            $this->clauses = [$this->statements];
            $this->conditions = [$this->conditions];
        }
        $this->compound = true;

        $this->statements = array();
        $body->call($this);
        $this->clauses[] = $this->statements;
        $this->conditions[] = $conditions;
    }

    public function elseVhdl($conditions, $body)
    {
        $this->whentrue = $this->statements;
        $this->statements = array();
        $body->call($this);
    }

    public function generate($out, $indent)
    {
        $prefix = str_pad('', $indent, "  ");
        $out->print($prefix);

        if ($this->compound) {
            $conditions = $this->conditions->first->map($this->generate);
            $conditions = implode(' and ', $conditions);
            $out->print($prefix."IF ".$this->conditions." THEN");
            foreach ($this->clauses->first as $clause) {
                $clause->generate($out, $indent+1);
            }

            for ($i = 1; $i <= 100; $i++) {
                $statements = $this->clauses[$i];
                $conditions = $this->conditions[$i];
                foreach ($this->conditions as $condition) {
                    $results[] = $condition->generate();
                }
                $conditions = implode(" and ", $results);
                $out->print($prefix."ELSIF ".$conditions." THEN");
                foreach ($statements as $statement) {
                    $statement->generate($out, $indent+1);
                }
            }

            $out->print($prefix."END IF;");
        } elseif ($this->whentrue) {
            foreach ($this->conditions as $condition) {
                $results[] = $condition->generate();
            }
            $conditions = implode(" and ", $results);
            $out->print($prefix."IF ".$conditions." THEN");
            foreach ($this->whentrue as $whentrueItem) {
                $whentrueItem->generate($out, $indent+1);
            }
            $out->print($prefix."ELSE");
            foreach ($this->statements as $statement) {
                $statement->generate($out, $indent+1);
            }
            $out->print($prefix."END IF;");
        } else {
            foreach ($this->conditions as $condition) {
                $results[] = $condition->generate();
            }
            $conditions = implode(" and ", $results);
            $out->print($prefix."IF ".$conditions." THEN");
            foreach ($this->statements as $statement) {
                $statement->generate($out, $indent+1);
            }
            $out->print($prefix."END IF;");
        }
    }

}