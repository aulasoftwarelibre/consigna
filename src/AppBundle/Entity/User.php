<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="user")
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="Folder", mappedBy="user")
     */
    private $folders;

    /**
     * @ORM\ManyToMany(targetEntity="Folder", inversedBy="usersWithAccess")
     */
    private $sharedFolders;

    /**
     * Construct
     */
    public function __construct(){
        parent::__construct();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sharedFolders=new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set id
     *
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id= $id;

        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * @param mixed $google_id
     */
    public function setGoogleId( $google_id )
    {
        $this->google_id = $google_id;
    }

    /**
     * @return mixed
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }

    /**
     * @param mixed $google_access_token
     */
    public function setGoogleAccessToken( $google_access_token )
    {
        $this->google_access_token = $google_access_token;
    }

    /**
     * Add files
     *
     * @param \AppBundle\Entity\File $files
     * @return User
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
     * @return mixed
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * @param mixed $folders
     */
    public function setFolders($folders)
    {
        $this->folders = $folders;
    }

    /**
     * @return mixed
     */
    public function getSharedFolders()
    {
        return $this->sharedFolders;
    }

    /**
     * @param mixed $sharedFolders
     */
    public function setSharedFolders($sharedFolders)
    {
        $this->sharedFolders = $sharedFolders;
    }

    /**
     * Add folders
     *
     * @param \AppBundle\Entity\Folder $folders
     * @return User
     */
    public function addFolder(\AppBundle\Entity\Folder $folders)
    {
        $this->folders[] = $folders;

        return $this;
    }

    /**
     * Remove folders
     *
     * @param \AppBundle\Entity\Folder $folders
     */
    public function removeFolder(\AppBundle\Entity\Folder $folders)
    {
        $this->folders->removeElement($folders);
    }

    /**
     * Add sharedFolders
     *
     * @param \AppBundle\Entity\Folder $sharedFolders
     * @return User
     */
    public function addSharedFolder(\AppBundle\Entity\Folder $sharedFolders)
    {
        $this->sharedFolders[] = $sharedFolders;

        return $this;
    }

    /**
     * Remove sharedFolders
     *
     * @param \AppBundle\Entity\Folder $sharedFolders
     */
    public function removeSharedFolder(\AppBundle\Entity\Folder $sharedFolders)
    {
        $this->sharedFolders->removeElement($sharedFolders);
    }
}
