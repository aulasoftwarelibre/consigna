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

namespace Bundle\FolderBundle\EventDispatcher;

use Bundle\FolderBundle\ConsignaFolderEvents;
use Bundle\FolderBundle\Entity\Interfaces\FolderInterface;
use Bundle\FolderBundle\Event\FolderOnCreatedEvent;
use Bundle\FolderBundle\Event\FolderOnDeletedEvent;
use Bundle\FolderBundle\Event\FolderOnPreDeleteEvent;
use Component\Core\EventDispatcher\Abstracts\AbstractEventDispatcher;

class FolderEventDispatcher extends AbstractEventDispatcher
{
    public function dispatchFolderOnCreatedEvent(FolderInterface $folder)
    {
        $event = new FolderOnCreatedEvent($folder);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaFolderEvents::FOLDER_CREATED, $event);

        return $this;
    }

    public function dispatchFolderOnPreDeleteEvent(FolderInterface $folder)
    {
        $event = new FolderOnPreDeleteEvent($folder);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaFolderEvents::FOLDER_PREDELETE, $event);

        return $this;
    }

    public function dispatchFolderOnDeletedEvent(FolderInterface $folder)
    {
        $event = new FolderOnDeletedEvent($folder);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaFolderEvents::FOLDER_DELETED, $event);

        return $this;
    }
}
