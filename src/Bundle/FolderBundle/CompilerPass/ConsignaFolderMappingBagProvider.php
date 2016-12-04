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

namespace Bundle\FolderBundle\CompilerPass;

use Bundle\CoreBundle\Mapping\XmlMappingBagCollection;
use Bundle\FolderBundle\DependencyInjection\ConsignaFolderExtension;
use Mmoreram\BaseBundle\Mapping\MappingBagCollection;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;

class ConsignaFolderMappingBagProvider implements MappingBagProvider
{
    public function getMappingBagCollection(): MappingBagCollection
    {
        return XmlMappingBagCollection::create(
            ['folder' => 'Folder'],
            '@ConsignaFolderBundle',
            'Bundle\FolderBundle\Entity',
            ConsignaFolderExtension::EXTENSION_NAME
        );
    }
}
