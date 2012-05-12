<?php

namespace ComputerBuild\ArchitectureBlock;

class ContainerExample
{
    public function __construct()
    {
        // define blocks
        $adder1 = new Adder();
        $adder2 = new Adder();
        $comparator = new Comparator();

        $container1 = new ContainerBlock();
        // architecture @todo turn this perhaps into a yaml file?
        // or better way of wiring things

        $container1->setArchitecture($adder1, $adder2, $comparator);
        $container1->wireUpIn($adder1, 'i1');
        $container1->wireUpIn($adder1, 'i2');
        $container1->wireUpIn($adder2, 'i2');
        $container1->wireUpIn($adder2, 'i3');
        $container1->wireUpOutIn($comparator, $adder1);
        $container1->wireUpOutIn($comparator, $adder2);

        // now we can encapsulate container2
        return $container1;
    }

    public function generate(GeneratedOutput $out)
    {
        $out->printLine('Something');
    }
}