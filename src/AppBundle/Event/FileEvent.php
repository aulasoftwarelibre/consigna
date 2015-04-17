<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\File;

class FileEvent extends Event
{
    private $file;

    function __construct(File $file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }
}