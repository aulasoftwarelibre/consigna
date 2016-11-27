<?php


namespace AppBundle\EventListener\Security;

use AppBundle\Event\ConsignaEvents;
use AppBundle\Event\UserAccessSharedEvent;
use AppBundle\Model\ShareableInterface;
use AppBundle\Model\UserInterface;
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
        /** @var ShareableInterface $object */
        $object = $event->getObject();

        if ($user instanceof UserInterface) {
            $object->addSharedWithUser($user);
            $this->entityManager->persist($object);
            $this->entityManager->flush();
        } else {
            $this->session->set($object->getSharedCode(), time());
        }
    }
}
