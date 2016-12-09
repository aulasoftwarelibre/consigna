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

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Model\Traits\UploadableTrait;

/**
 * Class File.
 */
class File extends Item implements FileInterface
{
    use UploadableTrait;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $scanStatus;

    /**
     * File constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->scanStatus = self::SCAN_STATUS_PENDING;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return File
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set original name.
     *
     * @param array $info
     */
    public function configureFileCallback(array $info)
    {
        $this->name = $info['origFileName'];
    }

    /**
     * @return string
     */
    public function getScanStatus()
    {
        return $this->scanStatus;
    }

    /**
     * @param string $scanStatus
     *
     * @return File
     */
    public function setScanStatus(string $scanStatus)
    {
        $this->scanStatus = $scanStatus;

        return $this;
    }

    public function getBasename()
    {
        return pathinfo($this->path, PATHINFO_BASENAME);
    }
}
