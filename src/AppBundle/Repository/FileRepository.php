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

namespace AppBundle\Repository;

use AppBundle\Entity\File;
use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Repository\Interfaces\FileRepositoryInterface;
use Doctrine\ORM\AbstractQuery;

class FileRepository extends ItemRepository implements FileRepositoryInterface
{
    // OLD

    public function deleteExpired()
    {
        $qb = $this->_em->createQueryBuilder();
        $query = $qb->delete('MovedBundle:File', 'file')
            ->andWhere($qb->expr()->andX(
                $qb->expr()->isNull('file.folder'),
                'file.expiresAt < :now'
            ))
            ->orWhere('file.scanStatus = :virus')
            ->setParameter('now', new \DateTime())
            ->setParameter('virus', File::SCAN_STATUS_INFECTED)
            ->getQuery();

        return $query->getScalarResult();
    }

    public function sizeAndNumOfFiles()
    {
        $qb = $this->createQueryBuilder('o');
        $query = $qb
            ->select('SUM(o.size) AS total')
            ->addSelect('COUNT (o) AS files')
            ->where('o.scanStatus = :status')
            ->setParameter('status', File::SCAN_STATUS_OK)
            ->getQuery();

        return $query->getOneOrNullResult(AbstractQuery::HYDRATE_ARRAY);
    }
}
