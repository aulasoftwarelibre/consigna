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

namespace AppBundle\EventListener;

use AppBundle\Entity\Interfaces\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;
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
