<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\File;

/**
 * Class FileEvent.
 */
class FileEvent extends Event
{
    /**
     * @var File
     */
    private $file;

    /**
     * @param $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }
}
