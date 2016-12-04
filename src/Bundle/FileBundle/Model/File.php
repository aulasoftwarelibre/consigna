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

namespace Bundle\FileBundle\Entity;

use AppBundle\Util\RandomStringGenerator;
use Bundle\FileBundle\Entity\Interfaces\FileInterface;
use Component\Core\Model\Traits\ExpirableTrait;
use Component\Core\Model\Traits\OwneableTrait;
use Component\Core\Model\Traits\ProtectableTrait;
use Component\Core\Model\Traits\ShareableTrait;
use Component\Core\Model\Traits\TaggeableTrait;
use Component\Core\Model\Traits\TimestampableTrait;
use Component\Core\Model\Traits\TraceableTrait;
use Component\Core\Model\Traits\UploadableTrait;
use Component\Folder\Model\Interfaces\FolderInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class File.
 */
class File implements FileInterface
{
    use ExpirableTrait;

    use ProtectableTrait;

    use OwneableTrait;

    use ShareableTrait;

    use TaggeableTrait;

    use TimestampableTrait;

    use TraceableTrait;

    use UploadableTrait;

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $scanStatus;

    /**
     * @var FolderInterface
     */
    protected $folder;

    /**
     * File constructor.
     */
    public function __construct()
    {
        $this->salt = RandomStringGenerator::length(16);
        $this->scanStatus = self::SCAN_STATUS_PENDING;
        $this->sharedCode = RandomStringGenerator::length(16);
        $this->sharedWithUsers = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * To string.
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return File
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
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
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return File
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return FolderInterface
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param FolderInterface $folder
     *
     * @return File
     */
    public function setFolder(FolderInterface $folder = null)
    {
        $this->folder = $folder;

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
