<?php


namespace AppBundle\EventListener\Security;

use AppBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserLoginListener implements EventSubscriberInterface
{
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    public function __construct(SessionInterface $session, AuthorizationCheckerInterface $authorization)
    {
        $this->session = $session;
        $this->authorization = $authorization;
    }

    /**
     * @{@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'security.interactive_login' => 'onSecurityInteractiveLogin',
        ];
    }

    /**
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        /** @var UserInterface $user */
        $user = $event->getAuthenticationToken()->getUser();

        if (!$user->getOrganization()->isEnabled()) {
            $ex = new DisabledException('alert.organization_disabled');
            $ex->setUser($user);

            throw $ex;
        }

        if ($this->authorization->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->session->clear();
        }
    }
}
