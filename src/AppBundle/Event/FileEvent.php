<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\File;
use Monolog\Logger;

class FileEvent extends Event
{
    private $file;

    private $logger;

    function __construct(File $file, Logger $logger)
    {
        $this->file = $file;
        $this->logger = $logger;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getLogger()
    {
        return $this->logger->addInfo('File has been scanned');
    }
}