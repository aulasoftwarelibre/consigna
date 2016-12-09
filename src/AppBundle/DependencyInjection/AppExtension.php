<?php

namespace AppBundle\DependencyInjection;

use AppBundle\DependencyInjection\Abstracts\AbstractExtension;

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
            'eventDispatchers',
            'eventListeners',
            'factories',
            'forms',
            'providers',
            'security',
            'services',
            'twig',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigFilesLocation(): string
    {
        return __DIR__.'/../Resources/config';
    }
}
