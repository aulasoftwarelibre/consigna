<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 8/04/15
 * Time: 13:20.
 */

namespace AppBundle\EventListener\Doctrine;

use AppBundle\Model\FileInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class FileInterfaceListener implements EventSubscriber
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof FileInterface) {
            $this->updateUserFields($object);
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof FileInterface) {
            $this->updateUserFields($object);
        }
    }

    protected function updateUserFields(FileInterface $object)
    {
        if ($object instanceof FileInterface) {
            if (0 !== strlen($password = $object->getPlainPassword())) {
                $encoder = $this->encoderFactory->getEncoder($object);
                $object->setPassword($encoder->encodePassword($password, $object->getSalt()));
                $object->eraseCredentials();
            }
        }
    }
}
