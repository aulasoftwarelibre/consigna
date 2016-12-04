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

namespace Bundle\CoreBundle\Mapping;

use Mmoreram\BaseBundle\Mapping\MappingBag;
use Mmoreram\BaseBundle\Mapping\MappingBagCollection;

class XmlMappingBagCollection extends MappingBagCollection
{
    public static function create(
        array $entities,
        string $bundleNamespace,
        string $componentNamespace,
        string $containerPrefix = '',
        string $managerName = 'default',
        string $containerObjectManagerName = 'object_manager',
        string $containerObjectRepositoryName = 'object_repository',
        bool $isOverwritable = false
    ): MappingBagCollection {
        $mappingBagCollection = new self();
        foreach ($entities as $entityName => $entityClass) {
            $mappingBagCollection
                ->addMappingBag(new MappingBag(
                    $bundleNamespace,
                    $componentNamespace,
                    $entityName,
                    $entityClass,
                    'Resources/config/doctrine/'.$entityClass.'.orm.xml',
                    $managerName,
                    true,
                    $containerObjectManagerName,
                    $containerObjectRepositoryName,
                    $containerPrefix,
                    $isOverwritable
                ));
        }

        return $mappingBagCollection;
    }
}
