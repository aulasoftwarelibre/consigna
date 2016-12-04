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

namespace Component\Folder\Model;

use AppBundle\Util\RandomStringGenerator;
use Component\Core\Model\Traits\ExpirableTrait;
use Component\File\Model\Interfaces\FileInterface;
use Component\Folder\Model\Interfaces\FolderInterface;
use Component\Core\Model\Traits\OwneableTrait;
use Component\Core\Model\Traits\ProtectableTrait;
use Component\Core\Model\Traits\ShareableTrait;
use Component\Core\Model\Traits\TaggeableTrait;
use Component\Core\Model\Traits\TimestampableTrait;
use Component\Core\Model\Traits\TraceableTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Folder.
 */
class Folder implements FolderInterface
{
    use ExpirableTrait;

    use ProtectableTrait;

    use OwneableTrait;

    use ShareableTrait;

    use TaggeableTrait;

    use TimestampableTrait;

    use TraceableTrait;

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
     * @var bool
     */
    protected $isPermanent;

    /**
     * @var ArrayCollection
     */
    protected $files;

    /**
     * @var ArrayCollection
     */
    protected $sharedWithUsers;

    /**
     * @var ArrayCollection
     */
    protected $tags;

    /**
     * Folder constructor.
     */
    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->isPermanent = false;
        $this->salt = RandomStringGenerator::length(16);
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
     * @return Folder
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
     * @return Folder
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
     * @return Folder
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function isPermanent()
    {
        return $this->isPermanent;
    }

    /**
     * @param bool $permanent
     *
     * @return Folder
     */
    public function setPermanent(bool $permanent)
    {
        $this->isPermanent = $permanent;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param FileInterface $file
     *
     * @return $this
     */
    public function addFile(FileInterface $file)
    {
        $file->setFolder($this);
        $this->files->add($file);

        return $this;
    }

    /**
     * @param FileInterface $file
     */
    public function removeFile(FileInterface $file)
    {
        $file->setFolder(null);
        $this->files->removeElement($file);
    }
}
