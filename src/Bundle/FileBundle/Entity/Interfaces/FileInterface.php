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

namespace Bundle\FileBundle\Entity\Interfaces;

use Bundle\CoreBundle\Model\Interfaces\ExpirableInterface;
use Bundle\CoreBundle\Model\Interfaces\OwnableInterface;
use Bundle\CoreBundle\Model\Interfaces\ProtectableInterface;
use Bundle\CoreBundle\Model\Interfaces\ResourceInterface;
use Bundle\CoreBundle\Model\Interfaces\ShareableInterface;
use Bundle\CoreBundle\Model\Interfaces\TaggeableInterface;
use Bundle\CoreBundle\Model\Interfaces\TimestampableInterface;
use Bundle\CoreBundle\Model\Interfaces\TraceableInterface;
use Bundle\CoreBundle\Model\Interfaces\UploadableInterface;
use Bundle\FolderBundle\Entity\Interfaces\FolderInterface;

interface FileInterface extends
    ExpirableInterface,
    OwnableInterface,
    ProtectableInterface,
    ResourceInterface,
    ShareableInterface,
    TaggeableInterface,
    TimestampableInterface,
    TraceableInterface,
    UploadableInterface
{
    /**
     * No virus detected.
     */
    const SCAN_STATUS_OK = 'scan.ok';
    /**
     * Pending to scan.
     */
    const SCAN_STATUS_PENDING = 'scan.pending';
    /**
     * Scanning failed.
     */
    const SCAN_STATUS_FAILED = 'scan.failed';
    /**
     * Virus detected.
     */
    const SCAN_STATUS_INFECTED = 'scan.infected';

    public function getName();

    public function setName(string $name);

    public function getDescription();

    public function setDescription(string $description);

    public function getSlug();

    public function setSlug(string $slug);

    public function getFolder();

    public function setFolder(FolderInterface $folder = null);

    public function getScanStatus();

    public function setScanStatus(string $scanStatus);
}
