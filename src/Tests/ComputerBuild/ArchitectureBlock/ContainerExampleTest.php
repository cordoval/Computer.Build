<?php

namespace Tests\ComputerBuild\ArchitectureBlock;

use ComputerBuild\ArchitectureBlock\ContainerExample;

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

        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, null);

        var_dump($container->getConfiguration()->getConfigTreeBuilder());
    }

    public function testSomethingElse()
    {

    }
}
