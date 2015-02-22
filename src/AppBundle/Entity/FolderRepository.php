<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 15/02/15
 * Time: 20:31
 */

namespace AppBundle\Entity;
use Doctrine\ORM\EntityRepository;


class FolderRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery('
            SELECT c
            FROM AppBundle:Folder c
            ORDER BY c.folderName ASC
        ');
        return $query->getResult();
    }

    public function myFolders($owner)
    {
        $em = $this->getEntityManager();
        $query=$em->createQuery('
            SELECT c
            FROM AppBundle:Folder c
            WHERE c.user LIKE :owner
            ORDER BY c.foldername ASC'
        );
        $query->setParameter('owner', $owner);
        return $query->getResult();
    }

    public function findFolders($word)
    {
        $em = $this->getEntityManager();
        $query=$em->createQuery('
            SELECT c,d
            FROM AppBundle:Folder c
            LEFT JOIN c.tags d
            WHERE c.folderName LIKE :word
            OR d.tagName LIKE :word
            ORDER BY c.folderName ASC'
        );
        $query->setParameter('word', '%'.$word.'%');
        return $query->getResult();
    }
}