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
use Doctrine\Common\Collections\ArrayCollection;

trait ShareableTrait
{
    /**
     * @var string
     */
    protected $sharedCode;

    /**
     * @var ArrayCollection
     */
    protected $sharedWithUsers;

    /**
     * Get shared code.
     *
     * @return string
     */
    public function getSharedCode()
    {
        return $this->sharedCode;
    }

    /**
     * Set shared code.
     *
     * @param string $sharedCode
     *
     * @return $this
     */
    public function setSharedCode(string $sharedCode)
    {
        $this->sharedCode = $sharedCode;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSharedWithUsers()
    {
        return $this->sharedWithUsers;
    }

    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function addSharedWithUser(UserInterface $user)
    {
        if (!$this->hasAccess($user)) {
            $this->sharedWithUsers->add($user);
        }

        return $this;
    }

    /**
     * @param UserInterface $user
     */
    public function removeSharedWithUser(UserInterface $user)
    {
        if ($this->hasAccess($user)) {
            $this->sharedWithUsers->removeElement($user);
        }
    }

    private function hasAccess(UserInterface $user)
    {
        $this
            ->getSharedWithUsers()
            ->exists(function(UserInterface $member) use ($user) {
                return $user == $member;
            });
    }
}
