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

namespace Component\Core\EventListener;

use Gedmo\Blameable\BlameableListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserTraceSubscriber implements EventSubscriberInterface
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var BlameableListener
     */
    private $blameableListener;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * Constructor.
     *
     * @param BlameableListener                  $blameableListener
     * @param TokenStorageInterface|null         $tokenStorage
     * @param AuthorizationCheckerInterface|null $authorizationChecker
     */
    public function __construct(BlameableListener $blameableListener, TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->blameableListener = $blameableListener;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (null === $this->tokenStorage) {
            return;
        }

        $token = $this->tokenStorage->getToken();

        if (null !== $token && $this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $this->blameableListener->setUserValue($token->getUser());
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
