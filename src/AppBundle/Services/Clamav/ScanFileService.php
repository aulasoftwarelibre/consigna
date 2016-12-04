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

use Component\File\Model\Interfaces\FileInterface;
use Xenolope\Quahog\Client;
use Socket\Raw\Factory;

class ScanFileService implements ScanFileServiceInterface
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $port;

    public function __construct(string $host, string $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @{@inheritdoc}
     */
    public function scan(FileInterface $file)
    {
        $factory = new Factory();
        $socket = $factory->createClient($this->host.':'.$this->port);

        $quahog = new Client($socket);
        $result = $quahog->scanFile($file->getPath());

        return new ScanedFile($file, $result);
    }
}
