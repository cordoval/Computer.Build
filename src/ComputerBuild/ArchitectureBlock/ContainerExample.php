<?php
namespace ComputerBuild\ArchitectureBlock;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use ComputerBuild\Vhdl\PortFactory;

/**
 * @author Luis Cordova <cordoval@gmail.com>
 */
class ContainerExample
{
    protected $container;

    /**
     * This class will wire 2 adders and a comparator automatically
     * over using Dependency Injection
     */
    public function __construct()
    {
        $this->container = new ContainerBuilder();
        $directory = __DIR__;
        $loader = new YamlFileLoader($container, new FileLocator($directory));
        $loader->load('booting.yml');

        // this instantiation can be automated into a yml schematic like file
        list($port1, $port2, $port3, $port4) = $this->$container->get('port.factory')->create(PortFactory::DIRECTION_IN, 4, 'in');
        $port5 = $this->$container->get('port.factory')->create(PortFactory::DIRECTION_OUT, 1, 'out');
        $adder1 = $this->$container->get('adder.factory')->create();
        $adder2 = $this->$container->get('adder.factory')->create();
        $comparator = $this->$container->get('comparator.factory')->create();

        $wiring = $this->$container->get('wiring');

        /**
         *  horizontal reuse of components injected
         *  automation in wiring things up
         *
         *           output
         *              |
         *         comparator
         *          |      |
         *        adder1  adder2
         *        |  |    |  |
         *       i1  i2  i3  i4
         */

        $wiring->buildCircuitList(
            array(
                array($adder1 => $comparator),
                array($adder2 => $comparator),
                array($port1 => $adder1),
                array($port2 => $adder1),
                array($port3, $adder2),
                array($port4, $adder2),
                array($comparator, $port5),
            )
        );
    }

    /**
     * Reponsibilities:
     * Drivers inputs to outputs using compute from inputs to outputs.
     */
    public function compute()
    {
        $this->container->getCircuitList();

    }

    public function generate(GeneratedOutput $out)
    {
        $out->printLine('Someting');
    }
}

/**
 * Default wiring service
 */
class WiringService implements WiringServiceInterface
{
    public function wireUp($source, $target)
    {

    }
}

interface WiringServiceInterface
{
    public function wireUp($source, $target);
}

/**
 * Smarter wiring service
 */
class SmarterWiringService implements WiringServiceInterface
{
    public function wireUp($source, $target)
    {

    }
}
