<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 30/01/15
 * Time: 20:35.
 */
namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\File;
use AppBundle\Entity\Folder;
use AppBundle\Entity\User;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use CL\Tissue\Adapter\ClamAv\ClamAvAdapter;

class FileRepository extends EntityRepository
{
    public function deleteLapsedFiles($date)
    {
        $em = $this->getEntityManager();
        $files = $em->getRepository('AppBundle:File')->findAll();
        foreach ($files as $file) {
            if ($file->getCreatedAt() <= $date) {
                $em->remove($file);
            }
        }
        $em->flush();
    }

    public function scanAllFiles($antivirusPath)
    {
        $em = $this->getEntityManager();
        $files = $em->getRepository('AppBundle:File')->findAll();
        $adapter = new ClamAVAdapter($antivirusPath);
        foreach ($files as $file) {
            $result = $adapter->scan([$file->getPath()]);
            if ($result->hasVirus()) {
                $em->remove($file);
            } else {
                $file->setScanStatus(File::SCAN_STATUS_OK);
                $em->persist($file);
            }
        }
        $em->flush();
    }

    public function sizeAndNumOfFiles()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT SUM(c.size) total, COUNT (c) files
            FROM AppBundle:File c
            WHERE c.scanStatus = :status'
        );
        $query->setParameter('status', File::SCAN_STATUS_OK);

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
                $qb->expr()->andX('folder.permanent = false and folder.expiresAt > :now'),
                'folder.permanent = true'
            ))
            ->orderBy($orderBy[0], $orderBy[1])
            ->setParameter('status', File::SCAN_STATUS_OK)
            ->setParameter('now', new \DateTime())
        ;

        if ($owner) {
            $query = $query->andWhere('file.owner = :owner')
                ->setParameter('owner', $owner)
            ;
        }

        if ($shared) {
            $query = $query->leftJoin('file.sharedWith', 'users')
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
