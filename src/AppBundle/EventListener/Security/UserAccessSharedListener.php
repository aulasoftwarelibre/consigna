<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 14/08/15
 * Time: 04:41.
 */

namespace AppBundle\EventListener\Security;

use AppBundle\Entity\User;
use AppBundle\Event\ConsignaEvents;
use AppBundle\Event\UserAccessSharedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserAccessSharedListener implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * UserAccessSharedListener constructor.
     */
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ConsignaEvents::FILE_ACCESS_SUCCESS => 'onAccess',
            ConsignaEvents::FOLDER_ACCESS_SUCCESS => 'onAccess',
        ];
    }

    public function onAccess(UserAccessSharedEvent $event, $eventName = null)
    {
        $user = $event->getUser();
        $object = $event->getObject();

        if ($user instanceof User) {
            $object->addSharedWith($user);
            $this->entityManager->persist($object);
            $this->entityManager->flush();
        } else {
            $this->session->set($object->getShareCode(), time());
        }
    }
}
