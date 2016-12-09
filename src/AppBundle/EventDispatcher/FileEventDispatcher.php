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
use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Event\FileOnDownloadedEvent;
use AppBundle\Event\FileOnPreCreateEvent;
use AppBundle\Event\FileOnUploadedEvent;
use AppBundle\Event\ItemOnSharedEvent;
use AppBundle\EventDispatcher\Abstracts\AbstractEventDispatcher;

class FileEventDispatcher extends AbstractEventDispatcher
{
    public function dispatchFolderOnPreCreateEvent(FileInterface $file)
    {
        $event = new FileOnPreCreateEvent($file);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FILE_PRECREATE, $event);
    }

    public function dispatchFileOnSharedEvent(FileInterface $file, ?UserInterface $user)
    {
        $event = new ItemOnSharedEvent($file, $user);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FILE_SHARED, $event);
    }

    public function dispatchFileOnUploadedEvent(FileInterface $file)
    {
        $event = new FileOnUploadedEvent($file);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FILE_UPLOADED, $event);
    }

    public function dispatchFileOnDownloadedEvent(FileInterface $file, ?UserInterface $user = null)
    {
        $event = new FileOnDownloadedEvent($file, $user);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::FILE_DOWNLOADED, $event);
    }
}
