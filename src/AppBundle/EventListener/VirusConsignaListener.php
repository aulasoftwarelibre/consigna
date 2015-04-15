<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 15/04/15
 * Time: 23:28
 */

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\File;
use Monolog\Logger;


class VirusConsignaListener
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof File) {
            $this->logger->addInfo('File '.$entity->getFilename().' has been scanned');
        }
    }
}