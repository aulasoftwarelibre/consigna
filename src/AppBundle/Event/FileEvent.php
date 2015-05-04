<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\File;

/**
 * Class FileEvent
 * @package AppBundle\Event
 */
class FileEvent extends Event
{
    /*
     * @var File
     */
    /**
     * @var
     */
    private $file;

    /**
     * @param $file
     */
    function __construct($file)
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