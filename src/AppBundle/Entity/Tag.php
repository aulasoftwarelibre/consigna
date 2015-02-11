<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tag
{
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Tag
     * @ORM\ManyToMany(targetEntity="File", mappedBy="tags")
     */
    private $files;

    public function __construct(){
        $this->files= new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="tagName", type="string")
     *
     */
    private $tagName;

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
     * To String
     *
     * @return string
     */
    function __toString()
    {
        return $this->getTagName();
    }
}
