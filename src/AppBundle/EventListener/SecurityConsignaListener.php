<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 8/04/15
 * Time: 13:20
 */

namespace AppBundle\EventListener;

use AppBundle\Model\FileInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class SecurityConsignaListener implements EventSubscriber
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory=$encoderFactory;
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
        $this->handleEvent($args);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->handleEvent($args);
    }

    private function handleEvent(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof FileInterface) {
            if ( 0 !== strlen($password = $entity->getPlainPassword()) ){
                $encoder = $this->encoderFactory->getEncoder($entity);
                $entity->setPassword( $encoder->encodePassword( $password, $entity->getSalt()) );
                $entity->eraseCredentials();
            }
        }
    }
}
