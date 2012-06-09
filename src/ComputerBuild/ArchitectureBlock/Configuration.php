<?php

namespace ComputerBuild\ArchitectureBlock;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wiring');

        $rootNode
            ->children()
                ->arrayNode('blocks')
                    ->children()
                        ->arrayNode('i')
                        ->end()
                        ->arrayNode('o')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}