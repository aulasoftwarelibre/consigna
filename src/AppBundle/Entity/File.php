<?php

namespace AppBundle\Entity;

use AppBundle\Model\FileInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * File.
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\FileRepository")
 * @Gedmo\Uploadable(filenameGenerator="SHA1", callback="configureFileCallback")
 */
class File implements FileInterface
{
    /**
     * Scan file status
     */
    const SCAN_STATUS_OK = 1;
    const SCAN_STATUS_PENDING = 2;
    const SCAN_STATUS_FAILED = 3;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255)
     * @Gedmo\UploadableFileName
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     * @Gedmo\UploadableFilePath
     */
    private $path;

    /**
     * @ORM\Column(name="mime_type", type="string")
     * @Gedmo\UploadableFileMimeType
     */
    private $mimeType;

    /**
     * @ORM\Column(name="size", type="decimal")
     * @Gedmo\UploadableFileSize
     */
    private $size;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="files")
     */
    private $owner;

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="files")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="sharedFiles")
     */
    private $sharedWith;

    /**
     * @ORM\Column(length=128, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="files")
     */
    private $folder;

    /**
     * @var string
     *
     * @ORM\Column(name="shareCode", type="string", length=255)
     */
    private $shareCode;

    /**
     * @var string
     *
     * @ORM\Column(name="scanStatus", type="string", length=255)
     */
    private $scanStatus;

    /**
     * @ORM\Column(type="string")
     */
    private $ipAddress;

    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sharedWith = new \Doctrine\Common\Collections\ArrayCollection();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->shareCode = bin2hex(openssl_random_pseudo_bytes(8));
        $this->scanStatus = self::SCAN_STATUS_PENDING;
    }

    /**
     * To String.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return File
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     * @return File
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string 
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return File
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return File
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return File
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return File
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }


    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * Remove credentials
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return File
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set shareCode
     *
     * @param string $shareCode
     * @return File
     */
    public function setShareCode($shareCode)
    {
        $this->shareCode = $shareCode;

        return $this;
    }

    /**
     * Get shareCode
     *
     * @return string 
     */
    public function getShareCode()
    {
        return $this->shareCode;
    }

    /**
     * Set scanStatus
     *
     * @param string $scanStatus
     * @return File
     */
    public function setScanStatus($scanStatus)
    {
        $this->scanStatus = $scanStatus;

        return $this;
    }

    /**
     * Get scanStatus
     *
     * @return string 
     */
    public function getScanStatus()
    {
        return $this->scanStatus;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return File
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     * @return File
     */
    public function setOwner(\AppBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\Tag $tags
     * @return File
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \AppBundle\Entity\Tag $tags
     */
    public function removeTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add sharedWith
     *
     * @param \AppBundle\Entity\User $sharedWith
     * @return File
     */
    public function addSharedWith(\AppBundle\Entity\User $sharedWith)
    {
        $this->sharedWith[] = $sharedWith;

        return $this;
    }

    /**
     * Remove sharedWith
     *
     * @param \AppBundle\Entity\User $sharedWith
     */
    public function removeSharedWith(\AppBundle\Entity\User $sharedWith)
    {
        $this->sharedWith->removeElement($sharedWith);
    }

    /**
     * Get sharedWith
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSharedWith()
    {
        return $this->sharedWith;
    }

    /**
     * Set folder
     *
     * @param \AppBundle\Entity\Folder $folder
     * @return File
     */
    public function setFolder(\AppBundle\Entity\Folder $folder = null)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return \AppBundle\Entity\Folder 
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Has access.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return bool
     */
    public function hasAccess($user)
    {
        if ($this->getOwner() == $user) {
            return true;
        }
        foreach ($this->sharedWith as $uWithAccess) {
            if ($user == $uWithAccess) {
                return true;
            }
        }

        return false;
    }

    /**
     * Configure unique name
     *
     * @param $info
     */
    public function configureFileCallback($info)
    {
        $this->setName($info['origFileName']);
        $this->setSlug(sha1(mt_rand()));
    }
}
