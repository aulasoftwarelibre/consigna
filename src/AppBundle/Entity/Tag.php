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
use AppBundle\Model\TagInterface;
use Component\Folder\Model\Interfaces\FolderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tag.
 */
class Tag implements TagInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     * @Assert\Length(min="1", max="50")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var Tag
     * @Assert\Valid()
     */
    private $files;

    /**
     * @var Tag
     * @Assert\Valid()
     */
    private $folders;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->folders = new ArrayCollection();
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName(string $name)
    {
        $this->name = $name;

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
     * Add files.
     *
     * @param FileInterface $files
     *
     * @return Tag
     */
    public function addFile(FileInterface $files)
    {
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files.
     *
     * @param FileInterface $files
     */
    public function removeFile(FileInterface $files)
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
     * Add folders.
     *
     * @param FolderInterface $folders
     *
     * @return Tag
     */
    public function addFolder(FolderInterface $folders)
    {
        $this->folders[] = $folders;

        return $this;
    }

    /**
     * Remove folders.
     *
     * @param FolderInterface $folders
     */
    public function removeFolder(FolderInterface $folders)
    {
        $this->folders->removeElement($folders);
    }

    /**
     * Get folders.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFolders()
    {
        return $this->folders;
    }
}
