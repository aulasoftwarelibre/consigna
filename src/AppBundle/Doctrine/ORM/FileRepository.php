<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 30/01/15
 * Time: 20:35.
 */

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\File;
use Doctrine\ORM\EntityRepository;
use CL\Tissue\Adapter\ClamAv\ClamAvAdapter;


class FileRepository extends EntityRepository
{
    public function listFiles()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT file
            FROM AppBundle:File file
            WHERE file.folder IS NULL
            AND file.scanStatus = :status
            ORDER BY file.name ASC'
        );

        $query->setParameter('status',File::SCAN_STATUS_OK);
        return $query->getResult();
    }

    public function findFiles($word)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT file, tag
            FROM AppBundle:File file
            LEFT JOIN file.tags tag
            WHERE file.name LIKE :word
            OR tag.name LIKE :word
            AND file.scanStatus = :status
            ORDER BY file.name ASC'
        );
        $query->setParameter('word', '%'.$word.'%');
        $query->setParameter('status',File::SCAN_STATUS_OK);

        return $query->getResult();
    }

    public function myFiles($owner)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT file
            FROM AppBundle:File file
            WHERE file.owner = :owner
            AND file.scanStatus = :status
            ORDER BY file.name ASC'
        );
        $query->setParameter('owner', $owner);
        $query->setParameter('status',File::SCAN_STATUS_OK);

        return $query->getResult();
    }

    public function findSharedFiles($user)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT file, user
            FROM AppBundle:File file
            JOIN file.sharedWith user
            WHERE user.username = :user
            AND file.scanStatus = :status
            ORDER BY file.name ASC'
        );
        $query->setParameter('user', $user->getUsername());
        $query->setParameter('status',File::SCAN_STATUS_OK);

        return $query->getResult();
    }

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
            SELECT SUM(c.size), COUNT (c)
            FROM AppBundle:File c
            WHERE c.scanStatus = :status'
        );
        $query->setParameter('status',File::SCAN_STATUS_OK);
        return $query->getArrayResult();
    }

    public function num()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT COUNT (c)
            FROM AppBundle:File c
            WHERE c.scanStatus = :status'
        );
        $query->setParameter('status',File::SCAN_STATUS_OK);
        return $query->getSingleScalarResult();
    }
}
