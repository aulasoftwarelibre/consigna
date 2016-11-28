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

use AppBundle\Model\FileInterface;
use AppBundle\Model\FolderInterface;
use AppBundle\Model\OrganizationInterface;
use AppBundle\Model\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var OrganizationInterface|null
     * @ORM\ManyToOne(targetEntity="AppBundle\Model\OrganizationInterface", inversedBy="users")
     */
    protected $organization;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Model\GroupInterface")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Model\FileInterface", mappedBy="owner", cascade={"persist", "remove"})
     */
    protected $files;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Model\FolderInterface", mappedBy="owner", cascade={"persist", "remove"})
     */
    protected $folders;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Model\FileInterface", mappedBy="sharedWithUsers", cascade={"persist", "remove"})
     */
    protected $sharedFiles;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Model\FolderInterface", mappedBy="sharedWithUsers", cascade={"persist", "remove"})
     */
    protected $sharedFolders;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->files = new ArrayCollection();
        $this->folders = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->sharedFiles = new ArrayCollection();
        $this->sharedFolders = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return OrganizationInterface|null
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param OrganizationInterface|null $organization
     *
     * @return User
     */
    public function setOrganization(OrganizationInterface $organization = null)
    {
        $this->organization = $organization;

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
        $file->setOwner($this);
        $this->files->add($file);

        return $this;
    }

    /**
     * @param FileInterface $file
     *
     * @return $this
     */
    public function removeFile(FileInterface $file)
    {
        $file->setOwner(null);
        $this->files->removeElement($file);
    }

    /**
     * @return ArrayCollection
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * @param FolderInterface $folder
     *
     * @return $this
     */
    public function addFolder(FolderInterface $folder)
    {
        $folder->setOwner($this);
        $this->folders->add($folder);

        return $this;
    }

    /**
     * @param FolderInterface $folder
     *
     * @return $this
     */
    public function removeFolder(FolderInterface $folder)
    {
        $folder->setOwner(null);
        $this->folders->removeElement($folder);
    }

    /**
     * @return ArrayCollection
     */
    public function getSharedFiles()
    {
        return $this->sharedFiles;
    }

    /**
     * @param FileInterface $sharedFile
     *
     * @return $this
     */
    public function addSharedFile(FileInterface $sharedFile)
    {
        $this->sharedFiles->add($sharedFile);

        return $this;
    }

    /**
     * @param FileInterface $sharedFile
     *
     * @return $this
     */
    public function removeSharedFile(FileInterface $sharedFile)
    {
        $this->sharedFiles->removeElement($sharedFile);
    }

    /**
     * @return ArrayCollection
     */
    public function getSharedFolders()
    {
        return $this->sharedFolders;
    }

    /**
     * @param FolderInterface $sharedFolder
     *
     * @return $this
     */
    public function addSharedFolder(FolderInterface $sharedFolder)
    {
        $this->sharedFolders->add($sharedFolder);

        return $this;
    }

    /**
     * @param FolderInterface $sharedFolder
     */
    public function removeSharedFolder(FolderInterface $sharedFolder)
    {
        $this->sharedFolders->removeElement($sharedFolder);
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param int    $s    Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d    Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r    Maximum rating (inclusive) [ g | pg | r | x ]
     * @param bool   $img  True to return a complete IMG tag False for just the URL
     * @param array  $atts Optional, additional key/value attributes to include in the IMG tag
     *
     * @return string containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($s = 80, $d = 'mm', $r = 'g', $img = false, $atts = [])
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($this->getEmail())));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="'.$url.'"';
            foreach ($atts as $key => $val) {
                $url .= ' '.$key.'="'.$val.'"';
            }
            $url .= ' />';
        }

        return $url;
    }
}
