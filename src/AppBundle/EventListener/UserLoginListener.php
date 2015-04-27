<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 27/04/15
 * Time: 20:18
 */

namespace AppBundle\EventListener;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserLoginListener
{
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    function __construct(SessionInterface $session, AuthorizationCheckerInterface $authorization)
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
        if ($this->authorization->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->session->clear();
        }
    }
}