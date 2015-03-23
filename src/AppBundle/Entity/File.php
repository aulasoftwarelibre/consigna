<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Nelmio\Alice\ORM\Doctrine;


/**
 * File
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\FileRepository")
 *
 */

class File
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploadDate", type="datetime")
     */
    private $uploadDate;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="files")
     */
    private $user;

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="files")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="sharedFiles")
     */
    private $usersWithAccess;

    /**
     * @Gedmo\Slug(fields={"filename"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Folder", inversedBy="files")
     */
    private $folder;


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
     * Set name
     *
     * @param string $filename
     * @return File
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }


    /**
     * Set uploadDate
     *
     * @param \DateTime $uploadDate
     * @return File
     */
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    /**
     * Get uploadDate
     *
     * @return \DateTime 
     */
    public function getUploadDate()
    {
        return $this->uploadDate;
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return File
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Tag
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param mixed $folder
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    /**
     * To String
     *
     * @return string
     */
    function __toString()
    {
        return $this->getFilename();
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

    public function __construct(){
        $this->tags= new \Doctrine\Common\Collections\ArrayCollection();
        $this->usersWithAccess=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usersWithAccess
     *
     * @param \AppBundle\Entity\User $usersWithAccess
     * @return File
     */
    public function addUsersWithAccess(\AppBundle\Entity\User $usersWithAccess)
    {
        $this->usersWithAccess[] = $usersWithAccess;

        return $this;
    }

    /**
     * Remove usersWithAccess
     *
     * @param \AppBundle\Entity\User $usersWithAccess
     */
    public function removeUsersWithAccess(\AppBundle\Entity\User $usersWithAccess)
    {
        $this->usersWithAccess->removeElement($usersWithAccess);
    }

    /**
     * Get usersWithAccess
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsersWithAccess()
    {
        return $this->usersWithAccess;
    }

    /**
     * Has access
     *
     * @param \AppBundle\Entity\User $user
     * @return bool
     */
    public function hasAccess($user){

        if ($this->getUser()==$user)
            return true;
        foreach ($this->usersWithAccess as $uWithAccess){
            if($user==$uWithAccess)
                return true;
        }
        return false;
    }

}
