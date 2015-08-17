<?php

namespace AppBundle\Entity;

use AppBundle\Model\FileInterface;
use AppBundle\Model\Traits\ExpirableEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\IpTraceable\Traits\IpTraceableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Folder.
 *
 * @ORM\Table(name="folder")
 * @ORM\Entity(repositoryClass="AppBundle\Doctrine\ORM\FolderRepository")
 */
class Folder implements FileInterface
{
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
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Length(min="3", max="255")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var User
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="folders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $owner;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="folders")
     */
    private $tags;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="sharedFolders")
     */
    private $sharedWith;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="File", mappedBy="folder", cascade="all")
     */
    private $files;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
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
     * @var bool
     *
     * @ORM\Column(name="is_permanent", type="boolean")
     */
    private $permanent;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sharedWith = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->shareCode = base64_encode(bin2hex(openssl_random_pseudo_bytes(15)));
        $this->permanent = false;
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
     * @return Folder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

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
     * @return Folder
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * @return Folder
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
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
     * @return Folder
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

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
     * @return Folder
     */
    public function setShareCode($shareCode)
    {
        $this->shareCode = $shareCode;

        return $this;
    }

    /**
     * Add tags.
     *
     * @param \AppBundle\Entity\Tag $tags
     *
     * @return Folder
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
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
     * Get tags.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add sharedWith.
     *
     * @param \AppBundle\Entity\User $sharedWith
     *
     * @return Folder
     */
    public function addSharedWith(\AppBundle\Entity\User $sharedWith)
    {
        $this->sharedWith[] = $sharedWith;

        return $this;
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
     * Get sharedWith.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSharedWith()
    {
        return $this->sharedWith;
    }

    /**
     * Add files.
     *
     * @param \AppBundle\Entity\File $files
     *
     * @return Folder
     */
    public function addFile(\AppBundle\Entity\File $files)
    {
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files.
     *
     * @param \AppBundle\Entity\File $files
     */
    public function removeFile(\AppBundle\Entity\File $files)
    {
        $this->files->removeElement($files);
    }

    /**
     * Get files.
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
     * @return Folder
     */
    public function setOwner(\AppBundle\Entity\User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get plain password.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set plain password.
     *
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * Get permanent.
     *
     * @return bool
     */
    public function isPermanent()
    {
        return $this->permanent;
    }

    /**
     * Set permanent.
     *
     * @param bool $permanent
     */
    public function setPermanent($permanent)
    {
        $this->permanent = $permanent;
    }

    /**
     * Remove credentials.
     */
    public function eraseCredentials()
    {
        $this->setPlainPassword(null);
    }
}
