<?php

namespace ComputerBuild\ArchitectureBlock;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Luis Cordova <cordoval@gmail.com>
 */
class ContainerExample
{
    /**
     * This class will wire 2 adders and a comparator automatically
     * over using Dependency Injection
     */
    public function __construct()
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__));
        $loader->load('booting.yml');

        // @mytodo work on Configurator.php
        /**
         * services:
         *      adder:
         *          class: Adder
         *          wireStrategy: ~
         *      comparator:
         *          class: Adder
         *          wireStrategy: ~
         */

        /* we are going to move this to configuration #1 */
        $container->register('adder.factory', 'FactoryAdder');
        $container->register('comparator.factory', 'FactoryComparator');
        $container->register('wiring', 'WiringService');
        $container->register('adder.factory', 'FactoryAdder');

        $adder1 = $container->get('adder.factory')->create();
        $adder2 = $container->get('adder.factory')->create();
        $comparator = $container->get('comparator.factory')->create();
        $wiring = $container->get('wiring');
        /* we are going to move this to configuration */

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

        $wiring->wireUp($adder1, $comparator);
        $wiring->wireUp($adder2, $comparator);
        $wiring->wireUp('i1', $adder1);
        $wiring->wireUp('i2', $adder1);
        $wiring->wireUp('i3', $adder2);
        $wiring->wireUp('i4', $adder2);
        $wiring->wireUp($comparator, 'o1');

        return $container;
    }

    public function generate(GeneratedOutput $out)
    {
        $out->printLine('Something');
    }
}

/**
 * FactoryAdder class
 */
class FactoryAdder()
{

}

/**
 * Default implementation of an adder
 */
class Adder()
{

}

/**
 * FactoryComparator class
 */
class FactoryComparator()
{

}

class Comparator()
{

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