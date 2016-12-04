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

namespace Bundle\FolderBundle\Services;

use Bundle\CoreBundle\Services\ObjectDirector;
use Bundle\FolderBundle\Entity\Interfaces\FolderInterface;
use Bundle\FolderBundle\EventDispatcher\FolderEventDispatcher;

class FolderManager
{
    /**
     * @var ObjectDirector
     */
    private $folderDirector;
    /**
     * @var FolderEventDispatcher
     */
    private $folderEventDispatcher;

    public function __construct(
        ObjectDirector $folderDirector,
        FolderEventDispatcher $folderEventDispatcher
    ) {
        $this->folderDirector = $folderDirector;
        $this->folderEventDispatcher = $folderEventDispatcher;
    }

    public function createFolder(FolderInterface $folder)
    {
        $this
            ->folderDirector
            ->save($folder);

        $this
            ->folderEventDispatcher
            ->dispatchFolderOnCreatedEvent($folder);

        return $this;
    }

    public function deleteFolder(FolderInterface $folder)
    {
        $this
            ->folderEventDispatcher
            ->dispatchFolderOnPreDeleteEvent($folder);

        $this
            ->folderDirector
            ->remove($folder);

        $this
            ->folderEventDispatcher
            ->dispatchFolderOnDeletedEvent($folder);

        return $this;
    }
}
