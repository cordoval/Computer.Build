<?php

namespace Tests\ComputerBuild\ArchitectureBlock;

use ComputerBuild\ArchitectureBlock\ContainerExample;
use Symfony\Component\Config\Definition\Processor;
use ComputerBuild\ArchitectureBlock\Configuration;

class ContainerExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testServicesWereCreatedAndAreInContainer()
    {
        $container = new ContainerExample();

        // make sure that the components are inside
        $this->assertInstanceOf('ComputerBuild\ArchitectureBlock\Adder', $container->getContainer()->get('adder1_service'));
        $this->assertInstanceOf('ComputerBuild\ArchitectureBlock\Adder', $container->getContainer()->get('adder2_service'));
        $this->assertInstanceOf('ComputerBuild\ArchitectureBlock\Comparator', $container->getContainer()->get('comparator1_service'));
        $this->assertInstanceOf('ComputerBuild\Vhdl\Port', $container->getContainer()->get('port1_service'));
        $this->assertInstanceOf('ComputerBuild\Vhdl\Port', $container->getContainer()->get('port2_service'));
        $this->assertInstanceOf('ComputerBuild\Vhdl\Port', $container->getContainer()->get('port3_service'));
        $this->assertInstanceOf('ComputerBuild\Vhdl\Port', $container->getContainer()->get('port4_service'));
        $this->assertInstanceOf('ComputerBuild\Vhdl\Port', $container->getContainer()->get('port5_service'));

        // probe that wiring is as expected

    }

    public function testConfigurationTree()
    {
        $container = new ContainerExample();

    }

    public function testSomethingElse()
    {

    }
}
