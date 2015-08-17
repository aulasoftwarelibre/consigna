<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/08/15
 * Time: 02:19.
 */
namespace AppBundle\EventListener\Doctrine;

use AppBundle\Entity\File;
use AppBundle\Model\Traits\ExpirableEntity;
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

        /** @var ExpirableEntity $entity */
        $entity = $args->getObject();

        if (in_array('AppBundle\Model\Traits\ExpirableEntity', class_uses($entity))) {
            if ($entity instanceof File && $entity->getFolder()) {
                $entity->setExpiresAt(null);
            } else {
                $entity->setExpiresAt($this->expire_date);
            }
        }
    }
}
