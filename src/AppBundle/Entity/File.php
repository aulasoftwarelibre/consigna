<?php

namespace AppBundle\Entity;

use AppBundle\Model\FileInterface;
use AppBundle\Model\Traits\ExpirableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\IpTraceable\Traits\IpTraceableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * File.
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\FileRepository")
 * @Gedmo\Uploadable(filenameGenerator="SHA1", callback="configureFileCallback", appendNumber=true)
 */
class File implements FileInterface
{
    /**
     * No virus detected.
     */
    const SCAN_STATUS_OK = 1;
    /**
     * Pending to scan.
     */
    const SCAN_STATUS_PENDING = 2;
    /**
     * Scanning failed.
     */
    const SCAN_STATUS_FAILED = 3;
    /**
     * Virus detected.
     */
    const SCAN_STATUS_INFECTED = 4;

    /*
     * Hook ip-traceable behavior
     * updates createdFromIp, updatedFromIp fields
     */
    use IpTraceableEntity;

    /*
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /*
     * Hook expirable behaviour
     */
    use ExpirableEntity;

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
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="files")
     */
    private $folder;

    /**
     * @ORM\Column(name="mime_type", type="string")
     * @Gedmo\UploadableFileMimeType
     */
    private $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var User
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="files")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     * @Gedmo\UploadableFilePath
     */
    private $path;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="scanStatus", type="string", length=255)
     */
    private $scanStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="shareCode", type="string", length=255)
     */
    private $shareCode;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="sharedFiles")
     */
    private $sharedWith;

    /**
     * @ORM\Column(name="size", type="decimal")
     * @Gedmo\UploadableFileSize
     */
    private $size;

    /**
     * @ORM\Column(length=128, unique=true)
     * @Gedmo\Slug(fields={"name"}, updatable=true)
     */
    private $slug;

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="files")
     */
    private $tags;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sharedWith = new \Doctrine\Common\Collections\ArrayCollection();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->shareCode = base64_encode(bin2hex(openssl_random_pseudo_bytes(15)));
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
     * Add sharedWith.
     *
     * @param \AppBundle\Entity\User $sharedWith
     *
     * @return File
     */
    public function addSharedWith(\AppBundle\Entity\User $sharedWith)
    {
        $this->sharedWith[] = $sharedWith;

        return $this;
    }

    /**
     * Add tags.
     *
     * @param \AppBundle\Entity\Tag $tags
     *
     * @return File
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove credentials.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
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
     * Get salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set salt.
     *
     * @param string $salt
     *
     * @return File
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get file.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file.
     *
     * @param string $file
     *
     * @return File
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get folder.
     *
     * @return \AppBundle\Entity\Folder
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set folder.
     *
     * @param \AppBundle\Entity\Folder $folder
     *
     * @return File
     */
    public function setFolder(\AppBundle\Entity\Folder $folder = null)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get mimeType.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set mimeType.
     *
     * @param string $mimeType
     *
     * @return File
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get owner.
     *
     * @return \AppBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set owner.
     *
     * @param \AppBundle\Entity\User $owner
     *
     * @return File
     */
    public function setOwner(\AppBundle\Entity\User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return File
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set path.
     *
     * @param string $path
     *
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function getBasename()
    {
        return pathinfo($this->path, PATHINFO_BASENAME);
    }

    /**
     * Get scanStatus.
     *
     * @return string
     */
    public function getScanStatus()
    {
        return $this->scanStatus;
    }

    /**
     * Set scanStatus.
     *
     * @param string $scanStatus
     *
     * @return File
     */
    public function setScanStatus($scanStatus)
    {
        $this->scanStatus = $scanStatus;

        return $this;
    }

    /**
     * Get shareCode.
     *
     * @return string
     */
    public function getShareCode()
    {
        return $this->shareCode;
    }

    /**
     * Set shareCode.
     *
     * @param string $shareCode
     *
     * @return File
     */
    public function setShareCode($shareCode)
    {
        $this->shareCode = $shareCode;

        return $this;
    }

    /**
     * Get sharedWith.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSharedWith()
    {
        return $this->sharedWith;
    }

    /**
     * Get size.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set size.
     *
     * @param string $size
     *
     * @return File
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return File
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get tags.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
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
     * Remove sharedWith.
     *
     * @param \AppBundle\Entity\User $sharedWith
     */
    public function removeSharedWith(\AppBundle\Entity\User $sharedWith)
    {
        $this->sharedWith->removeElement($sharedWith);
    }

    /**
     * Remove tags.
     *
     * @param \AppBundle\Entity\Tag $tags
     */
    public function removeTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
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
}
