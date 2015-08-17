<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/08/15
 * Time: 02:11.
 */
namespace AppBundle\Model\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ExpirableEntity
{
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expiresAt;

    /**
     * Get expiresAt.
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set expiresAt.
     *
     * @param \DateTime $expiresAt
     *
     * @return $this
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
