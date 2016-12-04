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

namespace Bundle\FileBundle\Repository;

use Bundle\FileBundle\Entity\File;
use Bundle\FileBundle\Entity\Interfaces\FileInterface;
use Bundle\FileBundle\Repository\Interfaces\FileRepositoryInterface;
use Component\User\Model\User;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;

class FileRepository extends EntityRepository implements FileRepositoryInterface
{
    public function deleteExpired()
    {
        $qb = $this->_em->createQueryBuilder();
        $query = $qb->delete('AppBundle:File', 'file')
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

    /**
     * @param $args
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneActiveBySlug($args)
    {
        $qb = $this->getQueryActive();
        $query = $qb->andWhere('file.slug = :slug')
            ->setParameter('slug', $args['slug'])
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * @param array $args
     * @param array $orderBy
     *
     * @return array
     */
    public function findActiveFilesBy(array $args = [], array $orderBy = ['file.name', 'ASC'])
    {
        $folder = array_key_exists('folder', $args) ? $args['folder'] : null;
        $owner = array_key_exists('owner', $args) ? $args['owner'] : null;
        $shared = array_key_exists('shared', $args) ? $args['shared'] : null;
        $search = array_key_exists('search', $args) ? $args['search'] : null;

        $qb = $this->getQueryActive($owner, $shared, $search, $orderBy);

        if ($folder) {
            $query = $qb->andWhere('file.folder = :folder')
                ->setParameter('folder', $folder)
            ;
        } else {
            $query = $qb->andWhere('file.folder IS NULL');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param User|null $owner
     * @param User|null $shared
     * @param null      $search
     * @param array     $orderBy
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getQueryActive(User $owner = null, User $shared = null, $search = null, array $orderBy = ['file.name', 'ASC'])
    {
        $qb = $this->createQueryBuilder('file');
        $query = $qb->select('file', 'folder', 'owner', 'organization', 'tags')
            ->leftJoin('file.folder', 'folder')
            ->leftJoin('file.owner', 'owner')
            ->leftJoin('owner.organization', 'organization')
            ->leftJoin('file.tags', 'tags')
            ->where('file.scanStatus = :status')
            ->andWhere($qb->expr()->orX(
                $qb->expr()->andX('file.folder IS NULL', 'file.expiresAt > :now'),
                $qb->expr()->andX('folder.isPermanent = false and folder.expiresAt > :now'),
                'folder.isPermanent = true'
            ))
            ->orderBy($orderBy[0], $orderBy[1])
            ->setParameter('status', FileInterface::SCAN_STATUS_OK)
            ->setParameter('now', new \DateTime())
        ;

        if ($owner) {
            $query = $query->andWhere('file.owner = :owner')
                ->setParameter('owner', $owner)
            ;
        }

        if ($shared) {
            $query = $query->leftJoin('file.sharedWithUsers', 'users')
                ->andWhere('users.id = :id')
                ->setParameter('id', $shared->getId())
            ;
        }

        if ($search) {
            $query = $query->andWhere($qb->expr()->orX(
                    'file.name LIKE :search',
                    'tags.name LIKE :search'
                ))
                ->setParameter('search', "%${search}%")
            ;
        }

        return $query;
    }
}
