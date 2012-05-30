<?php

namespace ComputerBuild\Vhdl;

use ComputerBuild\Filesystem\GeneratedOutput;

/**
 * Class to render single line statement
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
abstract class SingleLineStatement extends AbstractStatement
{
    abstract public function generate();
}
