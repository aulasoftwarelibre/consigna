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

namespace Bundle\TagBundle\CompilerPass;

use Bundle\CoreBundle\Mapping\XmlMappingBagCollection;
use Bundle\TagBundle\DependencyInjection\ConsignaTagExtension;
use Mmoreram\BaseBundle\Mapping\MappingBagCollection;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;

class ConsignaTagMappingBagProvider implements MappingBagProvider
{
    public function getMappingBagCollection(): MappingBagCollection
    {
        return XmlMappingBagCollection::create(
            ['tag' => 'Tag'],
            '@ConsignaTagBundle',
            'Component\Tag\Model',
            ConsignaTagExtension::EXTENSION_NAME
        );
    }
}
