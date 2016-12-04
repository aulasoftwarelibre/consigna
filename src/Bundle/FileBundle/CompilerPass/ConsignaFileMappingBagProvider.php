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

namespace Bundle\FileBundle\CompilerPass;

use Bundle\CoreBundle\Mapping\XmlMappingBagCollection;
use Bundle\FileBundle\DependencyInjection\ConsignaFileExtension;
use Mmoreram\BaseBundle\Mapping\MappingBagCollection;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;

class ConsignaFileMappingBagProvider implements MappingBagProvider
{
    public function getMappingBagCollection(): MappingBagCollection
    {
        return XmlMappingBagCollection::create(
            ['file' => 'File'],
            '@ConsignaFileBundle',
            'Component\File\Model',
            ConsignaFileExtension::EXTENSION_NAME
        );
    }
}
