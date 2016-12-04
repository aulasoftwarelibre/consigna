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

namespace MovedBundle\Services\Clamav;

use AppBundle\Entity\Interfaces\FileInterface;

class ScanedFile implements ScanedFileInterface
{
    const OK = 'OK';

    const FOUND = 'FOUND';

    const ERROR = 'ERROR';

    /**
     * @var FileInterface
     */
    private $file;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string|null
     */
    private $reason;

    public function __construct(FileInterface $file, array $result)
    {
        $this->file = $file;
        $this->status = $result['status'];
        $this->reason = $result['reason'];
    }

    /**
     * @return FileInterface
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getReason()
    {
        return $this->reason;
    }
}
