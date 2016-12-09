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

use AppBundle\ConsignaEvents;
use AppBundle\Event\FileOnDownloadedEvent;
use AppBundle\Event\FileOnUploadedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class VirusConsignaListener.
 */
class FileLoggerListener implements EventSubscriberInterface
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
            ConsignaEvents::FILE_DOWNLOADED => 'onFileDownloaded',
            ConsignaEvents::FILE_UPLOADED => 'OnFileUploaded',
        ];
    }

    /**
     * @param FileOnDownloadedEvent $event
     */
    public function onFileDownloaded(FileOnDownloadedEvent $event)
    {
        $file = $event->getFile();

        $this->loggerInterface->info(
            sprintf('File "%s" has been downloaded by "%s" with IP [%s]',
                $file->getName(),
                $file->getOwner() ?? 'anonymous',
                $file->getCreatedFromIp()
            )
        );
    }

    /**
     * @param FileOnUploadedEvent $event
     */
    public function OnFileUploaded(FileOnUploadedEvent $event)
    {
        $file = $event->getFile();

        $this->loggerInterface->info(
            sprintf('File "%s" has been uploaded by "%s" with IP [%s]',
                $file->getName(),
                $file->getOwner() ?? 'anonymous',
                $file->getCreatedFromIp()
            )
        );
    }
}
