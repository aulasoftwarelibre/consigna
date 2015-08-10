<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 15/04/15
 * Time: 23:28
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\File;
use AppBundle\Event\FileEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Event\FileEvent;
use Psr\Log\LoggerInterface;
use CL\Tissue\Adapter\ClamAv\ClamAvAdapter;
use Doctrine\ORM\EntityManager;
use Swift_Mailer;


/**
 * Class VirusConsignaListener
 * @package AppBundle\EventListener
 */
class VirusConsignaListener implements EventSubscriberInterface
{
    /**
     * @var
     */
    private $antivirus_path ;

    /**
     * @var LoggerInterface
     */
    private $loggerInterface;


    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * @var Swift_Mailer
     */
    private $swiftMailer;


    /**
     * @param LoggerInterface $loggerInterface
     * @param EntityManager $entityManager
     * @param $antivirus_path
     * @param Swift_Mailer $mailer
     */
    function __construct(LoggerInterface $loggerInterface, EntityManager $entityManager, $antivirus_path, Swift_Mailer $mailer)
    {
        $this->loggerInterface = $loggerInterface;
        $this->entityManager= $entityManager;
        $this->antivirus_path = $antivirus_path;
        $this->swiftMailer = $mailer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FileEvents::SUBMITTED => 'onFileSubmitted'
        );
    }

    /**
     * @param FileEvent $event
     */
    public function onFileSubmitted(FileEvent $event)
    {
        $file = $event->getFile();
        $path = $file-> getPath();

        try {
            $adapter = new ClamAVAdapter($this->antivirus_path);
            $result = $adapter->scan([$path]);

            if ($result->hasVirus()) {
                $this->loggerInterface->info('File ' . $file . ' has been removed');
                $file->setScanStatus(File::SCAN_STATUS_INFECTED);
            } else {
                $this->loggerInterface->info('File ' . $file . ' has been scanned');
                $file->setScanStatus(File::SCAN_STATUS_OK);
            }

        } catch (\Exception $e) {
            $this->loggerInterface->info($e);
            $file->setScanStatus(File::SCAN_STATUS_FAILED);

            $mailer = $this->swiftMailer;
            $message = $mailer->createMessage()
                ->setSubject('Error scanning file')
                ->setFrom('consignauco@gmail.com')
                ->setTo('sergio@uco.es')
                ->setBody($e)
            ;
            $mailer->send($message);
        };

        $this->entityManager->persist($file);
        $this->entityManager->flush();
    }
}