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

use AppBundle\Model\ExpirableTrait;
use AppBundle\Model\FileInterface;
use AppBundle\Model\FolderInterface;
use AppBundle\Model\OwneableTrait;
use AppBundle\Model\ProtectableTrait;
use AppBundle\Model\ShareableTrait;
use AppBundle\Model\TaggeableTrait;
use AppBundle\Model\TagInterface;
use AppBundle\Model\TimestampableTrait;
use AppBundle\Model\TraceableTrait;
use AppBundle\Model\UserInterface;
use AppBundle\Util\RandomStringGenerator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Folder.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FolderRepository")
 * @ORM\Table(name="folder")
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
     * @Assert\Length(min="3", max="255")
     * @Assert\NotBlank()
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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $isPermanent;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Model\FileInterface", mappedBy="folder", cascade={"persist"})
     */
    protected $files;

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Model\UserInterface", inversedBy="folders")
     * @Gedmo\Blameable(on="create")
     */
    protected $owner;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Model\UserInterface", inversedBy="sharedFolders")
     * @ORM\JoinTable(name="folder_shared_user",
     *      joinColumns={@ORM\JoinColumn(name="folder_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $sharedWithUsers;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Model\TagInterface", inversedBy="folders")
     * @ORM\JoinTable(name="folder_tags",
     *      joinColumns={@ORM\JoinColumn(name="folder_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
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
