<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity()
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="sir_id", type="string", length=255, nullable=true) */
    protected $sir_id;

    /** @ORM\Column(name="sir_access_token", type="string", length=255, nullable=true) */
    protected $sir_access_token;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="user")
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity="Folder", mappedBy="user")
     */
    private $folders;

    /**
     * @ORM\ManyToMany(targetEntity="Folder", mappedBy="usersWithAccess")
     */
    private $sharedFolders;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="usersWithAccess")
     */
    private $sharedFiles;

    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="users")
     */
    private $organization;

    /**
     * Construct.
     */
    public function __construct()
    {
        parent::__construct();
        $this->files = new ArrayCollection();
        $this->sharedFolders = new ArrayCollection();
        $this->sharedFiles = new ArrayCollection();
        $this->groups = new ArrayCollection();
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
     * Set id.
     *
     * @param int $id
     *
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSirId()
    {
        return $this->sir_id;
    }

    /**
     * @param mixed $sir_id
     */
    public function setSirId( $sir_id )
    {
        $this->sir_id = $sir_id;
    }

    /**
     * @return mixed
     */
    public function getSirAccessToken()
    {
        return $this->sir_access_token;
    }

    /**
     * @param mixed $sir_access_token
     */
    public function setSirAccessToken( $sir_access_token )
    {
        $this->sir_access_token = $sir_access_token;
    }

    /**
     * Add files.
     *
     * @param \AppBundle\Entity\File $files
     *
     * @return User
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
     * Add folders.
     *
     * @param \AppBundle\Entity\Folder $folders
     *
     * @return User
     */
    public function addFolder(\AppBundle\Entity\Folder $folders)
    {
        $this->folders[] = $folders;

        return $this;
    }

    /**
     * Remove folders.
     *
     * @param \AppBundle\Entity\Folder $folders
     */
    public function removeFolder(\AppBundle\Entity\Folder $folders)
    {
        $this->folders->removeElement($folders);
    }

    /**
     * Add sharedFolders.
     *
     * @param \AppBundle\Entity\Folder $sharedFolders
     *
     * @return User
     */
    public function addSharedFolder(\AppBundle\Entity\Folder $sharedFolders)
    {
        $this->sharedFolders[] = $sharedFolders;

        return $this;
    }

    /**
     * Remove sharedFolders.
     *
     * @param \AppBundle\Entity\Folder $sharedFolders
     */
    public function removeSharedFolder(\AppBundle\Entity\Folder $sharedFolders)
    {
        $this->sharedFolders->removeElement($sharedFolders);
    }

    /**
     * Add sharedFiles.
     *
     * @param \AppBundle\Entity\User $sharedFiles
     *
     * @return User
     */
    public function addSharedFile(\AppBundle\Entity\User $sharedFiles)
    {
        $this->sharedFiles[] = $sharedFiles;

        return $this;
    }

    /**
     * Remove sharedFiles.
     *
     * @param \AppBundle\Entity\User $sharedFiles
     */
    public function removeSharedFile(\AppBundle\Entity\User $sharedFiles)
    {
        $this->sharedFiles->removeElement($sharedFiles);
    }

    /**
     * Get sharedFiles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSharedFiles()
    {
        return $this->sharedFiles;
    }

    /**
     * @return \AppBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization();
    }

    /**
     * @param \AppBundle\Entity\Organization $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /*
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param integer $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $this->getEmail() ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}
