<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/08/15
 * Time: 22:33.
 */

namespace AppBundle\Event;

use Component\Folder\Model\Folder;
use Symfony\Component\EventDispatcher\Event;

class FolderEvent extends Event
{
    /**
     * @var Folder
     */
    private $folder;

    /**
     * Construct.
     *
     * @param Folder $folder
     */
    public function __construct(Folder $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Get folder.
     *
     * @return Folder
     */
    public function getFolder()
    {
        return $this->folder;
    }
}
