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

namespace Component\Core\EventListener\Doctrine;

use Bundle\FileBundle\Entity\Interfaces\FileInterface;
use Component\Core\Model\Interfaces\ExpirableInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class ExpirableListener implements EventSubscriber
{
    private $expire_date;

    public function __construct($expire_date)
    {
        $this->expire_date = new \DateTime($expire_date);
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof ExpirableInterface) {
            if ($entity instanceof FileInterface && $entity->getFolder()) {
                $entity->setExpiresAt(null);
            } else {
                $entity->setExpiresAt($this->expire_date);
            }
        }
    }
}
