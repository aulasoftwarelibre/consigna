<?php

namespace Bundle\CoreBundle\DependencyInjection;

use Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractExtension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class ConsignaCoreExtension extends AbstractExtension
{
    const EXTENSION_NAME = 'consigna_core';

    protected function getConfigFiles($config)
    {
        return [
            'eventDispatcher',
        ];
    }

    protected function getConfigFilesLocation()
    {
        return __DIR__.'/../Resources/config';
    }

    public function getAlias()
    {
        return static::EXTENSION_NAME;
    }
}
