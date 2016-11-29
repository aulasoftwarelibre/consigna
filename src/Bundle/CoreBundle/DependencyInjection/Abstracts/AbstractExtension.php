<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bundle\CoreBundle\DependencyInjection\Abstracts;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

abstract class AbstractExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($config, $container);
        if ($configuration instanceof ConfigurationInterface) {
            $config = $this->processConfiguration($configuration, $config);
            // TODO: Something with this
        }

        $configFiles = $this->getConfigFiles($config);
        if (!empty($configFiles)) {
            $this->loadFiles($configFiles, $container);
        }
    }

    protected function getConfigFiles($config)
    {
        return [];
    }

    abstract protected function getConfigFilesLocation();

    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        $configuration = $this->getConfigurationInstance();

        if ($configuration) {
            $container->addObjectResource($configuration);
        }

        return $configuration;
    }

    protected function getConfigurationInstance()
    {
        return null;
    }

    protected function loadFiles(array $configFiles, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator($this->getConfigFilesLocation()));

        foreach ($configFiles as $configFile) {
            $loader->load($configFile.'.xml');
        }

        return $this;
    }
}
