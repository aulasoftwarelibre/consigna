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

use AppBundle\Event\FileOnUploadedEvent;
use AppBundle\Services\FileManager;
use Psr\Log\LoggerInterface;

/**
 * Class VirusConsignaListener.
 */
class FileVirusScanListener
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @param FileManager $fileManager
     * @param LoggerInterface $loggerInterface
     */
    public function __construct(
        FileManager $fileManager,
        LoggerInterface $loggerInterface
    ) {
        $this->fileManager = $fileManager;
        $this->loggerInterface = $loggerInterface;
    }

    /**
     * @param FileOnUploadedEvent $event
     */
    public function onFileUploaded(FileOnUploadedEvent $event)
    {
        $file = $event->getFile();

        $this
            ->fileManager
            ->scanFile($file);

        // TODO: LOG
    }
}
