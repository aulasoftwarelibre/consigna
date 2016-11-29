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

namespace Component\Folder\Event\Abstracts;

use Component\Folder\Model\Interfaces\FolderInterface;
use Symfony\Component\EventDispatcher\Event;

class AbstractFolderEvent extends Event
{
    /**
     * @var FolderInterface
     */
    private $folder;

    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * @return FolderInterface
     */
    public function getFolder()
    {
        return $this->folder;
    }
}
