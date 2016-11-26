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

use Quahog\Client;
use Socket\Raw\Factory;

class ScanFile implements ScanFileInterface
{
    public function scan($file)
    {
        $factory = new Factory();
        $socket = $factory->createClient('clamav:3310');

        $quahog = new Client($socket);
        $result = $quahog->scanFile($file);

        return $result;
    }
}
