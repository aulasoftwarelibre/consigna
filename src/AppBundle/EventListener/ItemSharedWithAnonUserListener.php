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


use AppBundle\Event\ItemOnSharedEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ItemSharedWithAnonUserListener
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @inheritDoc
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function onShared(ItemOnSharedEvent $event)
    {
        if ($event->getUser()) {
            return;
        }

        $this->session->set($event->getItem()->getSharedCode(), time());
    }
}