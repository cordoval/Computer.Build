<?php

namespace Tests\ComputerBuild\ArchitectureBlock;

use ComputerBuild\ArchitectureBlock\ContainerExample;

class ContainerExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testServicesWereCreatedAndAreInContainer()
    {
        $container = new ContainerExample();
    }

    public function testSomethingElse()
    {

    }
}
