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

namespace AppBundle\EventDispatcher;

use AppBundle\ConsignaEvents;
use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Event\FolderOnCreatedEvent;
use AppBundle\Event\FolderOnDeletedEvent;
use AppBundle\Event\FolderOnPreDeleteEvent;
use AppBundle\Event\ItemOnSharedEvent;
use AppBundle\EventDispatcher\Abstracts\AbstractEventDispatcher;

class FolderEventDispatcher extends AbstractEventDispatcher
{
    public function dispatchFolderOnCreatedEvent(FolderInterface $folder)
    {
        $event = new FolderOnCreatedEvent($folder);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FOLDER_CREATED, $event);

        return $this;
    }

    public function dispatchFolderOnDeletedEvent(FolderInterface $folder)
    {
        $event = new FolderOnDeletedEvent($folder);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FOLDER_DELETED, $event);

        return $this;
    }

    public function dispatchFolderOnPreDeleteEvent(FolderInterface $folder)
    {
        $event = new FolderOnPreDeleteEvent($folder);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FOLDER_PREDELETE, $event);

        return $this;
    }

    public function dispatchFolderOnSharedEvent(FolderInterface $folder, ?UserInterface $user)
    {
        $event = new ItemOnSharedEvent($folder, $user);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FOLDER_SHARED, $event);
    }
}
