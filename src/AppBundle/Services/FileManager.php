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

namespace AppBundle\Services;

use AppBundle\EventDispatcher\FileEventDispatcher;

class FileManager
{
    /**
     * @var ObjectDirector
     */
    private $fileDirector;
    /**
     * @var FileEventDispatcher
     */
    private $fileEventDispatcher;

    public function __construct(
        ObjectDirector $fileDirector,
        FileEventDispatcher $fileEventDispatcher
    ) {
        $this->fileDirector = $fileDirector;
        $this->fileEventDispatcher = $fileEventDispatcher;
    }
}
