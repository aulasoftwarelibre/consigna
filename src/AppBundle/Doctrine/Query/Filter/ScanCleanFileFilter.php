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


namespace AppBundle\Doctrine\Query\Filter;


use AppBundle\Entity\Interfaces\FileInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class ScanCleanFileFilter extends SQLFilter
{
    /**
     * @inheritDoc
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        $interfaces = $targetEntity->getReflectionClass()->getInterfaceNames();

        if (!in_array(FileInterface::class, $interfaces)) {
            return '';
        }

        return sprintf('%s.scanStatus = "%s"', $targetTableAlias, FileInterface::SCAN_STATUS_OK);
    }
}