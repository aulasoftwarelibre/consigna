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

namespace Bundle\TagBundle\DependencyInjection;

use Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractExtension;
use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ConsignaTagExtension extends AbstractExtension
{
    const EXTENSION_NAME = 'consigna_tag';

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
