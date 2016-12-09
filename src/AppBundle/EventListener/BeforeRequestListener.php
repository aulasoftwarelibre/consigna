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


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class BeforeRequestListener
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @inheritDoc
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this
            ->manager
            ->getFilters()
            ->enable('consigna_enabled_entity');

        $this
            ->manager
            ->getFilters()
            ->enable('consigna_expired_entity');

        $this
            ->manager
            ->getFilters()
            ->enable('consigna_scan_clean_file');

    }
}