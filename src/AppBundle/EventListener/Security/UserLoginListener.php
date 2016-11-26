<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 27/04/15
 * Time: 20:18.
 */

namespace AppBundle\EventListener\Security;

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
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if (!$user->getOrganization()->getIsEnabled()) {
            $ex = new DisabledException('alert.organization_disabled');
            $ex->setUser($user);
            throw $ex;
        }

        if ($this->authorization->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->session->clear();
        }
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
}
