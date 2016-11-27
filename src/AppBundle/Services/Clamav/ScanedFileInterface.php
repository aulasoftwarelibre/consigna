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


namespace AppBundle\Services\Clamav;


use AppBundle\Model\FileInterface;

interface ScanedFileInterface
{
    /**
     * @return FileInterface
     */
    public function getFile();

    /**
     * @return string|null
     */
    public function getReason();

    /**
     * @return string
     */
    public function getStatus();
}