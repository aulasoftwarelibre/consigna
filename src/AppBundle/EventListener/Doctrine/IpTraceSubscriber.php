<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 07/08/15
 * Time: 03:17.
 */

namespace AppBundle\EventListener\Doctrine;

use Gedmo\IpTraceable\IpTraceableListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class IpTraceSubscriber implements EventSubscriberInterface
{
    /**
     * @var IpTraceableListener
     */
    private $ipTraceableListener;

    /**
     * @var RequestStack
     */
    private $request;

    public function __construct(IpTraceableListener $ipTraceableListener, RequestStack $request = null)
    {
        $this->ipTraceableListener = $ipTraceableListener;
        $this->request = $request;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (null === $this->request) {
            return;
        }

        // If you use a cache like Varnish, you may want to set a proxy to Request::getClientIp() method
        // $this->request->setTrustedProxies(array('127.0.0.1'));

        $ip = $this->request->getCurrentRequest()->getClientIp();

        if (null !== $ip) {
            $this->ipTraceableListener->setIpValue($ip);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
