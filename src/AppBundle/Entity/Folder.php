<?php

namespace AppBundle\Entity;

use AppBundle\Model\FileInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Folder.
 *
 * @ORM\Table(name="folder")
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\FolderRepository")
 */
class Folder implements FileInterface
{
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(min="3", max="255")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploaded_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $uploadedAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="folders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $owner;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="files")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="sharedFolders")
     */
    private $sharedWith;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="File", mappedBy="folder", cascade="all")
     */
    private $files;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * Encrypted password. Must be persisted.
     *
     * @ORM\Column(name="password", type="string", length=255)
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
     * @var string
     *
     * @ORM\Column(name="shareCode", type="string", length=255)
     */
    private $shareCode;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sharedWith = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->shareCode = bin2hex(openssl_random_pseudo_bytes(8));
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Folder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Get uploadedAt
     *
     * @return \DateTime
     */
    public function getUploadedAt()
    {
        return $this->uploadedAt;
    }

    /**
     * Set uploadedAt
     *
     * @param \DateTime $uploadedAt
     * @return Folder
     */
    public function setUploadedAt($uploadedAt)
    {
        $this->uploadedAt = $uploadedAt;

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
     * Set slug
     *
     * @param string $slug
     * @return Folder
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * Set password
     *
     * @param string $password
     * @return Folder
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Set salt
     *
     * @param string $salt
     * @return Folder
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

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
     * Set shareCode
     *
     * @param string $shareCode
     * @return Folder
     */
    public function setShareCode($shareCode)
    {
        $this->shareCode = $shareCode;

        return $this;
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\Tag $tags
     * @return Folder
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
     * @return Folder
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
     * Add files
     *
     * @param \AppBundle\Entity\File $files
     * @return Folder
     */
    public function addFile(\AppBundle\Entity\File $files)
    {
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files
     *
     * @param \AppBundle\Entity\File $files
     */
    public function removeFile(\AppBundle\Entity\File $files)
    {
        $this->files->removeElement($files);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
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

        foreach ($this->sharedWith as $member) {
            if ($user == $member) {
                return true;
            }
        }

        return false;
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
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     * @return Folder
     */
    public function setOwner(\AppBundle\Entity\User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get plain password
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set plain password
     *
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
        $this->setPlainPassword(null);
    }
}
