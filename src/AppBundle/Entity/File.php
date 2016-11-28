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

use Component\Core\Model\Traits\ExpirableTrait;
use AppBundle\Model\FileInterface;
use AppBundle\Model\FolderInterface;
use Component\Core\Model\Traits\OwneableTrait;
use Component\Core\Model\Traits\ProtectableTrait;
use Component\Core\Model\Traits\ShareableTrait;
use Component\Core\Model\Traits\TaggeableTrait;
use Component\Core\Model\Traits\TimestampableTrait;
use Component\Core\Model\Traits\TraceableTrait;
use Component\Core\Model\Traits\UploadableTrait;
use AppBundle\Model\UserInterface;
use AppBundle\Util\RandomStringGenerator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class File.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FileRepository")
 * @ORM\Table(name="file")
 * @Gedmo\Uploadable(filenameGenerator="SHA1", callback="configureFileCallback", appendNumber=true)
 */
class File implements FileInterface
{
    use ExpirableTrait;

    use ProtectableTrait;

    use OwneableTrait;

    use ShareableTrait;

    use TimestampableTrait;

    use TaggeableTrait;

    use TraceableTrait;

    use UploadableTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=127, unique=true)
     * @Gedmo\Slug(fields={"name"}, unique=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256)
     */
    protected $scanStatus;

    /**
     * @var FolderInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Model\FolderInterface", inversedBy="files")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $folder;

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Model\UserInterface", inversedBy="files")
     * @ORM\JoinColumn(nullable=true)
     * @Gedmo\Blameable(on="create")
     */
    protected $owner;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Model\UserInterface", inversedBy="sharedFiles")
     * @ORM\JoinTable(name="file_shared_user",
     *      joinColumns={@ORM\JoinColumn(name="file_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $sharedWithUsers;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Model\TagInterface", inversedBy="files")
     * @ORM\JoinTable(name="file_tags",
     *      joinColumns={@ORM\JoinColumn(name="file_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
     */
    protected $tags;

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
