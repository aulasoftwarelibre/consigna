<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 15/04/15
 * Time: 23:28
 */

namespace AppBundle\EventListener;


use AppBundle\FileEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Event\FileEvent;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManager;


/**
 * Class VirusConsignaListener
 * @package AppBundle\EventListener
 */
class LogListener implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;


    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * @param LoggerInterface $loggerInterface
     * @param EntityManager $entityManager
     */
    function __construct(LoggerInterface $loggerInterface, EntityManager $entityManager)
    {
        $this->loggerInterface = $loggerInterface;
        $this->entityManager= $entityManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FileEvents::SUBMITTED => 'onFileSubmitted',
            FileEvents::DOWNLOADED => 'onFileDownloaded'
        );
    }

    /**
     * @param FileEvent $event
     */
    public function onFileSubmitted(FileEvent $event)
    {
        $file = $event->getFile();
        $this->entityManager->persist($file);
        $this->entityManager->flush();
        $this->loggerInterface->info('File ' . $file . ' has been uploaded by '.$file->getIpAddress());
    }

    /**
     * @param FileEvent $event
     */
    public function onFileDownloaded(FileEvent $event)
    {
        $file = $event->getFile();
        $this->entityManager->persist($file);
        $this->entityManager->flush();
        $this->loggerInterface->info('File ' . $file . ' has been downloaded by '.$file->getIpAddress());
    }
}