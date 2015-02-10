<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

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
    private $tag;


    public function __construct(){
        $this->tags= new \Doctrine\Common\Collections\ArrayCollection();
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
}
