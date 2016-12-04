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

namespace AppBundle\DependencyInjection\CompilerPass;

use AppBundle\DependencyInjection\AppExtension;
use Mmoreram\BaseBundle\Mapping\MappingBagCollection;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;

class ConsignaMappingBagProvider implements MappingBagProvider
{
    public function getMappingBagCollection(): MappingBagCollection
    {
        return XmlMappingBagCollection::create(
            [
                'file' => 'File',
                'folder' => 'Folder',
                'group' => 'Group',
                'organization' => 'Organization',
                'tag' => 'Tag',
                'user' => 'User',
            ],
            '@AppBundle',
            'AppBundle\Entity',
            AppExtension::EXTENSION_NAME
        );
    }
}
