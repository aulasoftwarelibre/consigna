<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 15/02/15
 * Time: 20:31.
 */

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\File;
use Doctrine\ORM\EntityRepository;

class FolderRepository extends EntityRepository
{
    public function myFolders($owner)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT c
            FROM AppBundle:Folder c
            WHERE c.user = :owner
            ORDER BY c.folderName ASC'
        );
        $query->setParameter('owner', $owner);

        return $query->getResult();
    }

    public function findFolders($word)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT c,d
            FROM AppBundle:Folder c
            LEFT JOIN c.tags d
            WHERE c.folderName LIKE :word
            OR d.name LIKE :word
            ORDER BY c.folderName ASC'
        );
        $query->setParameter('word', '%'.$word.'%');

        return $query->getResult();
    }

    public function findSharedFolders($user)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT c,d
            FROM AppBundle:Folder c
            JOIN c.usersWithAccess d
            WHERE d.username = :user
            ORDER BY c.folderName ASC'
        );
        $query->setParameter('user', $user->getUsername());

        return $query->getResult();
    }

    public function deleteLapsedFolders($date)
    {
        $em = $this->getEntityManager();
        $folders = $em->getRepository('AppBundle:Folder')->findAll();
        foreach ($folders as $folder) {
            if ($folder->getUploadDate() == $date) {
                $em->remove($folder);
                $em->persist($folder);
            }
        }
        $em->flush();
    }

    public function listFiles($folder)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT c
            FROM AppBundle:File c
            WHERE c.folder = :folder
            AND c.scanStatus = :status
            ORDER BY c.filename ASC'
        );

        $query->setParameter('status',File::SCAN_STATUS_OK);
        $query->setParameter('folder',$folder);
        return $query->getResult();
    }

}
