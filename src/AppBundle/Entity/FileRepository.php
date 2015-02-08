<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 30/01/15
 * Time: 20:35
 */


namespace AppBundle\Entity;
use Doctrine\ORM\EntityRepository;


class FileRepository extends EntityRepository
{

    public function findFiles($word)
    {
        $em = $this->getEntityManager();
        $query=$em->createQuery('
            SELECT c
            FROM AppBundle:File c
            WHERE c.filename LIKE :word'
        );
        $query->setParameter('word', '%'.$word.'%');
        return $query->getResult();
    }

    public function myFiles($owner)
    {
        $em = $this->getEntityManager();
        $query=$em->createQuery('
            SELECT c
            FROM AppBundle:File c
            WHERE c.owner LIKE :owner'
        );
        $query->setParameter('owner', $owner);
        return $query->getResult();
    }
}



