<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/08/15
 * Time: 02:19.
 */

namespace AppBundle\EventListener\Doctrine;

use AppBundle\Entity\File;
use Component\Core\Model\Interfaces\ExpirableInterface;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class ExpirableListener
{
    private $expire_date;

    public function __construct($expire_date)
    {
        $this->expire_date = new \DateTime($expire_date);
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof ExpirableInterface) {
            if ($entity instanceof File && $entity->getFolder()) {
                $entity->setExpiresAt(null);
            } else {
                $entity->setExpiresAt($this->expire_date);
            }
        }
    }
}
