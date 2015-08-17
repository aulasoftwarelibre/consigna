<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 15/04/15
 * Time: 23:28.
 */
namespace AppBundle\EventListener;

use AppBundle\Event\ConsignaEvents;
use AppBundle\Event\FileEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class VirusConsignaListener.
 */
class LoggerListener implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;

    /**
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->loggerInterface = $loggerInterface;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConsignaEvents::FILE_UPLOAD_SUCCESS => 'onFileSubmitted',
            ConsignaEvents::FILE_DOWNLOAD_SUCCESS => 'onFileDownloaded',
        ];
    }

    /**
     * @param FileEvent $event
     */
    public function onFileDownloaded(FileEvent $event)
    {
        $file = $event->getFile();
        $this->loggerInterface->info(
            'File '.$file.' has been downloaded by '.$file->getOwner().' with ip '.$file->getCreatedFromIp()
        );
    }

    /**
     * @param FileEvent $event
     */
    public function onFileSubmitted(FileEvent $event)
    {
        $file = $event->getFile();
        $this->loggerInterface->info(
            'File '.$file.' has been uploaded by '.$file->getOwner().' with ip '.$file->getCreatedFromIp()
        );
    }
}
