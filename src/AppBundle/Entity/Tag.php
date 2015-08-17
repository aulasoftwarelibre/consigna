<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tag.
 *
 * @ORM\Table(name="tag")
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
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\Length(min="1", max="50")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="File", mappedBy="tags")
     * @Assert\Valid()
     */
    private $files;

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="Folder", mappedBy="tags")
     * @Assert\Valid()
     */
    private $folders;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->folders = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function setName($name)
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
