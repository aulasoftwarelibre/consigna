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
            WHERE c.owner = :owner
            ORDER BY c.name ASC'
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
            WHERE c.name LIKE :word
            OR d.name LIKE :word
            ORDER BY c.name ASC'
        );
        $query->setParameter('word', '%'.$word.'%');

        return $query->getResult();
    }

    public function findSharedFolders($user)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
            SELECT folder, user
            FROM AppBundle:Folder folder
            LEFT JOIN folder.sharedWith user
            WHERE user.username = :user
            ORDER BY folder.name ASC
        ");
        $query->setParameter('user', $user->getUsername());

        return $query->getResult();
    }

    public function deleteLapsedFolders($date)
    {
        $em = $this->getEntityManager();
        $folders = $em->getRepository('AppBundle:Folder')->findBy(['isPermanent' => false]);
        foreach ($folders as $folder) {
            if ($folder->getCreatedAt() == $date) {
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
            SELECT file
            FROM AppBundle:File file
            WHERE file.folder = :folder
            AND file.scanStatus = :status
            ORDER BY file.name ASC'
        );

        $query->setParameter('status',File::SCAN_STATUS_OK);
        $query->setParameter('folder',$folder);
        return $query->getResult();
    }

}
