<?php

namespace ComputerBuild\ArchitectureBlock;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\Extension\ConfigurationExtensionInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Config\FileLocator;

class WiringServiceExtension implements ExtensionInterface
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $config    An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $config, ContainerBuilder $container)
    {
        var_export('i reach this far!');die;
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $directory = __DIR__;
        $loader = new XmlFileLoader($container, new FileLocator($directory));
        $loader->load('generateBlockWiring.yml');

    }

    private $classes = array();

    /**
     * Gets the classes to cache.
     *
     * @return array An array of classes
     */
    public function getClassesToCompile()
    {
        return $this->classes;
    }

    /**
     * Adds classes to the class cache.
     *
     * @param array $classes An array of classes
     */
    public function addClassesToCompile(array $classes)
    {
        $this->classes = array_merge($this->classes, $classes);
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return false;
    }

    /**
     * Returns the namespace to be used for this extension (XML namespace).
     *
     * @return string The XML namespace
     */
    public function getNamespace()
    {
        return 'http://example.org/schema/dic/'.$this->getAlias();
    }

    /**
     * Returns the recommended alias to use in XML.
     *
     * This alias is also the mandatory prefix to use when using YAML.
     *
     * This convention is to remove the "Extension" postfix from the class
     * name and then lowercase and underscore the result. So:
     *
     *     AcmeHelloExtension
     *
     * becomes
     *
     *     acme_hello
     *
     * This can be overridden in a sub-class to specify the alias manually.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        $className = get_class($this);
        if (substr($className, -9) != 'Extension') {
            throw new \BadMethodCallException('This extension does not follow the naming convention; you must overwrite the getAlias() method.');
        }
        $classBaseName = substr(strrchr($className, '\\'), 1, -9);

        return Container::underscore($classBaseName);
    }

    protected final function processConfiguration(ConfigurationInterface $configuration, array $configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration($configuration, $configs);
    }

    /**
     * {@inheritDoc}
     */
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        $reflected = new \ReflectionClass($this);
        $namespace = $reflected->getNamespaceName();

        $class = $namespace . '\\Configuration';
        if (class_exists($class)) {
            if (!method_exists($class, '__construct')) {
                $configuration = new $class();

                return $configuration;
            }
        }

        return null;
    }
}