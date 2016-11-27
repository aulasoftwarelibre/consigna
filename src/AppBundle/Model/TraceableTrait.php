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

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait TraceableTrait
{
    /**
     * @var string
     * @Gedmo\IpTraceable(on="create")
     * @ORM\Column(length=45, nullable=true)
     */
    protected $createdFromIp;

    /**
     * Sets createdFromIp.
     *
     * @param string $createdFromIp
     *
     * @return $this
     */
    public function setCreatedFromIp(string $createdFromIp)
    {
        $this->createdFromIp = $createdFromIp;

        return $this;
    }

    /**
     * Returns createdFromIp.
     *
     * @return string
     */
    public function getCreatedFromIp()
    {
        return $this->createdFromIp;
    }
}
