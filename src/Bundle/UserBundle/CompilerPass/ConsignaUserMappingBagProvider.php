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

namespace Bundle\UserBundle\CompilerPass;

use Bundle\CoreBundle\Mapping\XmlMappingBagCollection;
use Bundle\UserBundle\DependencyInjection\ConsignaUserExtension;
use Mmoreram\BaseBundle\Mapping\MappingBagCollection;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;

class ConsignaUserMappingBagProvider implements MappingBagProvider
{
    public function getMappingBagCollection(): MappingBagCollection
    {
        return XmlMappingBagCollection::create(
            [
                'user' => 'User',
                'group' => 'Group',
            ],
            '@ConsignaUserBundle',
            'Component\User\Model',
            ConsignaUserExtension::EXTENSION_NAME
        );
    }
}
