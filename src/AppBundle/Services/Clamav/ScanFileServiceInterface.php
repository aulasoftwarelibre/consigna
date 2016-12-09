<?php
/*
 * This file is part of the consigna.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Services\Clamav;

use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Services\Clamav\ScanedFile;

interface ScanFileServiceInterface
{
    /**
     * @param FileInterface $file
     *
     * @return ScanedFile
     */
    public function scan(FileInterface $file);
}
