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

namespace Bundle\FolderBundle\DependencyInjection;

use Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractExtension;

class ConsignaFolderExtension extends AbstractExtension
{
    const EXTENSION_NAME = 'consigna_folder';

    protected function getConfigFiles($config)
    {
        return [
            'directors',
            'eventDispatcher',
            'factories',
            'forms',
            'repositories',
            'services',
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
