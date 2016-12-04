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

namespace Component\File\Event\Abstracts;

use Component\File\Model\Interfaces\FileInterface;
use Symfony\Component\EventDispatcher\Event;

class AbstractFileEvent extends Event
{
    /**
     * @var FileInterface
     */
    private $file;

    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * @return FileInterface
     */
    public function getFile(): FileInterface
    {
        return $this->file;
    }
}
