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

namespace AppBundle\Model\Traits;

use AppBundle\Entity\Interfaces\UserInterface;

trait OwneableTrait
{
    /**
     * @var UserInterface
     */
    protected $owner;

    /**
     * @return UserInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param UserInterface $owner
     */
    public function setOwner(UserInterface $owner = null)
    {
        $this->owner = $owner;
    }
}