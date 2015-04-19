<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\File;

class FileEvent extends Event
{
    /*
     * @var File
     */
    private $file;

    function __construct($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getPath()
    {
        return $this->file->getPath();
    }

    public function setStatus($status)
    {
        return $this->file->setScanStatus($status);
    }
}