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

use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Repository\Interfaces\FolderRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class FolderRepository extends EntityRepository implements FolderRepositoryInterface
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

    public function findOneActiveBySlug($args)
    {
        $qb = $this->getQueryActive();
        $query = $qb->andWhere('folder.slug = :slug')
            ->setParameter('slug', $args['slug'])
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    public function findActiveFoldersBy(array $args = [], array $orderBy = ['folder.name', 'ASC'])
    {
        $owner = array_key_exists('owner', $args) ? $args['owner'] : null;
        $shared = array_key_exists('shared', $args) ? $args['shared'] : null;
        $search = array_key_exists('search', $args) ? $args['search'] : null;

        $qb = $this->getQueryActive($owner, $shared, $search, $orderBy);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param UserInterface|null $owner
     * @param UserInterface|null $shared
     * @param null               $search
     * @param array              $orderBy
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getQueryActive(UserInterface $owner = null, UserInterface $shared = null, $search = null, array $orderBy = ['folder.name', 'ASC'])
    {
        $qb = $this->createQueryBuilder('folder');
        $query = $qb->leftJoin('folder.tags', 'tags')
            ->leftJoin('folder.owner', 'owner')
            ->leftJoin('owner.organization', 'organization')
            ->addSelect('tags')
            ->addSelect('partial owner.{id}')
            ->addSelect('organization')
            ->where($qb->expr()->orX(
                'folder.expiresAt > :now',
                'folder.isPermanent = :true'
            ))
            ->orderBy($orderBy[0], $orderBy[1])
            ->setParameter('now', new \DateTime())
            ->setParameter('true', true)
        ;

        if ($owner) {
            $query = $query->andWhere('folder.owner = :owner')
                ->setParameter('owner', $owner)
            ;
        }

        if ($shared) {
            $query = $query->leftJoin('folder.sharedWithUsers', 'users')
                ->andWhere('users.id = :id')
                ->setParameter('id', $shared->getId())
            ;
        }

        if ($search) {
            $query = $query->leftJoin('folder.files', 'files')
                ->andWhere($qb->expr()->orX(
                    'folder.name LIKE :search',
                    'tags.name LIKE :search',
                    'files.name LIKE :search'
                ))
                ->setParameter('search', "%${search}%")
            ;
        }

        return $query;
    }
}
