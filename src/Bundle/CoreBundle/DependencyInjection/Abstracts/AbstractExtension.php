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

use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

abstract class AbstractExtension extends BaseExtension
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $config    An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $container->addObjectResource($this);

        $configuration = $this->getConfiguration($config, $container);
        if ($configuration instanceof ConfigurationInterface) {
            $config = $this->processConfiguration($configuration, $config);
            $this->applyParametrizedValues($config, $container);
        }

        $configFiles = $this->getConfigFiles($config);
        if (!empty($configFiles)) {
            $this->loadFiles($configFiles, $container);
        }

        $this->postLoad($config, $container);
    }

    /**
     * Apply parametrized values.
     *
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function applyParametrizedValues(
        array $config,
        ContainerBuilder $container
    ) {
        $parametrizationValues = $this->getParametrizationValues($config);
        if (is_array($parametrizationValues)) {
            $container
                ->getParameterBag()
                ->add($parametrizationValues);
        }
    }

    /**
     * Process configuration.
     *
     * @param ConfigurationInterface $configuration Configuration object
     * @param array                  $configs       Configuration stack
     *
     * @return array configuration processed
     */
    private function processConfiguration(ConfigurationInterface $configuration, array $configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration($configuration, $configs);
    }

    /**
     * Load multiple files.
     *
     * @param array            $configFiles Config files
     * @param ContainerBuilder $container   Container
     */
    private function loadFiles(array $configFiles, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator($this->getConfigFilesLocation()));

        foreach ($configFiles as $configFile) {
            if (is_array($configFile)) {
                if (isset($configFile[1]) && false === $configFile[1]) {
                    continue;
                }

                $configFile = $configFile[0];
            }

            $loader->load($configFile.'.xml');
        }
    }
}
