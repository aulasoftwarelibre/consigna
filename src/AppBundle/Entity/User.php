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

use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\ItemInterface;
use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\OrganizationInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User.
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var OrganizationInterface
     */
    protected $organization;

    /**
     * @var ArrayCollection
     */
    protected $groups;

    /**
     * @var ArrayCollection
     */
    protected $files;

    /**
     * @var ArrayCollection
     */
    protected $folders;

    /**
     * @var ArrayCollection
     */
    protected $sharedItems;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->files = new ArrayCollection();
        $this->folders = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->sharedItems = new ArrayCollection();
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
    public function getSharedItems()
    {
        return $this->sharedItems;
    }

    /**
     * @param ItemInterface $sharedItem
     *
     * @return $this
     */
    public function addSharedItem(ItemInterface $sharedItem)
    {
        $this->sharedItems->add($sharedItem);

        return $this;
    }

    /**
     * @param ItemInterface $sharedItem
     *
     * @return $this
     */
    public function removeSharedItem(ItemInterface $sharedItem)
    {
        $this->sharedItems->removeElement($sharedItem);
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
