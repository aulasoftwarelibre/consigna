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
use AppBundle\Event\FileEvent;


class VirusConsignaListener
{
    public function onFileSubmitted(FileEvent $event)
    {
        $file = $event->getFile();

    }
}