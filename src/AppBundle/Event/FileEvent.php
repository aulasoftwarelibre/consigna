<?php

namespace AppBundle\Event;

use Component\File\Model\Interfaces\FileInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class FileEvent.
 */
class FileEvent extends Event
{
    /**
     * @var FileInterface
     */
    private $file;

    /**
     * @param $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * @return FileInterface
     */
    public function getFile()
    {
        return $this->file;
    }
}
