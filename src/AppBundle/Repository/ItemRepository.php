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


use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\ItemInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Repository\Interfaces\ItemRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class ItemRepository extends EntityRepository implements ItemRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findAllActiveBy(array $criteria = [], array $orderBy = ['o.name', 'ASC']): ?array
    {
        $folder = $criteria['folder'] ?? null;
        $owner = $criteria['owner'] ?? null;
        $shared = $criteria['shared'] ?? null;
        $search = $criteria['search'] ?? null;

        return $this
            ->getActiveItems($folder, $owner, $shared, $search, $orderBy)
            ->getQuery()
            ->getResult();
    }

    /***
     * @inheritDoc
     */
    public function findOneActiveBy(array $args): ?ItemInterface
    {
        $qb = $this
            ->getActiveItems();

        foreach ($args as $field => $value) {
            $qb
                ->andWhere(sprintf('o.%s = :%s', $field, $field))
                ->setParameter($field, $value);
        }

        return $qb
            ->getQuery()
            ->getOneOrNullResult();

    }

    protected function getActiveItems(FolderInterface $folder = null, UserInterface $owner = null, UserInterface $shared = null, $search = null, array $orderBy = [])
    {
        $qb = $this->createQueryBuilder('o');
        $orderBy = $this->getOrderBy($orderBy);

        $qb
            ->addSelect('owner')
            ->addSelect('organization')
            ->addSelect('tag')
            ->leftJoin('o.owner', 'owner')
            ->leftJoin('owner.organization', 'organization')
            ->leftJoin('o.folder', 'folder')
            ->leftJoin('o.sharedWithUsers', 'shared_with_users')
            ->leftJoin('o.tags', 'tag')
            ->orderBy($orderBy);

        if ($owner) {
            $qb
                ->andWhere('o.owner = :owner')
                ->setParameter('owner', $owner);
        }

        if ($shared) {
            $qb
                ->andWhere('o.sharedWithUsers = :shared')
                ->setParameter('shared', $shared);
        }

        if ($search) {
            $qb
                ->andWhere($qb->expr()->orX(
                    'o.name LIKE :search',
                    'tags.name LIKE :search'
                ))
                ->setParameter('search', '%'.$search.'%');
        }

        if ($folder instanceof FolderInterface) {
            $qb
                ->andWhere('o.folder = :folder')
                ->setParameter('folder', $folder);
        } else {
            $qb
                ->andWhere('folder.id IS NULL');
        }

        return $qb;
    }

    protected function getOrderBy(array $orderBy): Expr\OrderBy
    {
        $orderBy['order'] = $orderBy['order'] ?? 'o.name';
        $orderBy['sort'] = $orderBy['sort'] ?? 'ASC';

        $order = in_array($orderBy['order'], ['o.name', 'o.createdAt']) ? $orderBy['order'] : 'o.name';
        $sort = in_array($orderBy['sort'], ['ASC', 'DESC']) ? $orderBy['sort'] : 'ASC';

        return new Expr\OrderBy($order, $sort);
    }
}