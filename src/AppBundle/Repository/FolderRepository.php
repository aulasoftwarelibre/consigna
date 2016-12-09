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

use AppBundle\Repository\Interfaces\FolderRepositoryInterface;

class FolderRepository extends ItemRepository implements FolderRepositoryInterface
{
    public function deleteExpired()
    {
        $qb = $this->_em->createQueryBuilder();
        $query = $qb
            ->delete('FolderBundle:Folder', 'folder')
            ->where('folder.expiresAt < :now')
            ->andWhere('folder.isPermanent = :false')
            ->setParameter('now', new \DateTime())
            ->setParameter('false', false)
            ->getQuery();

        return $query->getScalarResult();
    }
}
