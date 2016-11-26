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

interface ScanFileInterface
{
    public function scan($file);
}
