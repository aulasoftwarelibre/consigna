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


namespace AppBundle\Event;


use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Event\Abstracts\AbstractFileEvent;

final class FileOnDownloadedEvent extends AbstractFileEvent
{
    /**
     * @var UserInterface|null
     */
    private $user;

    /**
     * FileOnDownloadedEvent constructor.
     * @param FileInterface $file
     * @param UserInterface|null $user
     */
    public function __construct(FileInterface $file, ?UserInterface $user = null)
    {
        parent::__construct($file);
        $this->user = $user;
    }

    /**
     * @return ?UserInterface
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}