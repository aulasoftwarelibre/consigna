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

namespace Bundle\UserBundle\DependencyInjection;

use Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractExtension;
use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ConsignaUserExtension extends AbstractExtension
{
    const EXTENSION_NAME = 'consigna_user';

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
            'factories',
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
