<?php

namespace AppBundle\DependencyInjection;

use AppBundle\DependencyInjection\Abstracts\AbstractExtension;
use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class AppExtension extends AbstractExtension
{
    const EXTENSION_NAME = 'consigna';

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return static::EXTENSION_NAME;
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigFiles(array $config): array
    {
        return [
            'commands',
            'directors',
            'eventDispatcher',
            'factories',
            'forms',
            'services',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigFilesLocation(): string
    {
        return __DIR__.'/../Resources/config';
    }

    protected function getConfigurationInstance(): ? ConfigurationInterface
    {
        return new BaseConfiguration(
            static::EXTENSION_NAME,
            $this->mappingBagProvider
        );
    }
}
