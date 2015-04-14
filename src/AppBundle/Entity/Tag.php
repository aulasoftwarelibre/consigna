<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="tagName", type="string")
     */
    private $tagName;

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="File", mappedBy="tags")
     */
    private $files;

    public function __files_construct()
    {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="Folder", mappedBy="tags")
     */
    private $folders;

    public function __folders_construct()
    {
        $this->folders = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * @return Tag
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param Tag $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
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
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * @param string $tagName
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
    }

    /**
     * To String.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTagName();
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->folders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add files.
     *
     * @param \AppBundle\Entity\File $files
     *
     * @return Tag
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
     * Add folders.
     *
     * @param \AppBundle\Entity\Folder $folders
     *
     * @return Tag
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
     * Get folders.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFolders()
    {
        return $this->folders;
    }
}
