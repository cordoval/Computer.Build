<?php
namespace ComputerBuild\ArchitectureBlock;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\Definition\Processor;

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

        // how to use the extension to load specific configuration ?
        $directory = __DIR__;
        $loader = new YamlFileLoader($this->container, new FileLocator($directory));
        $loader->load('serviceImplementations.yml');
        $loader->load('generatingBlockServices.yml');

        $extensionDI = new WiringServiceExtension();
        //var_export($extensionDI->getAlias());die;
        $this->container->registerExtension($extensionDI);

        $this->container->compile();
        // with the config configuration we can wire things
        //$wiring = $this->container->get('wiring');

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
/*
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
*/
    }

    /**
     * Reponsibilities:
     * Drivers inputs to outputs using compute from inputs to outputs.
     */
    public function compute()
    {
        $this->container->getCircuitList();

    }

    public function getContainer()
    {
        return $this->container;
    }

    public function getConfiguration()
    {
        return $this->configuration;
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
