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

namespace AppBundle\Model\Interfaces;

use AppBundle\Entity\Interfaces\UserInterface;

interface ShareableInterface
{
    /**
     * Get shared code.
     *
     * @return string
     */
    public function getSharedCode();

    /**
     * Set shared code.
     *
     * @param string $sharedCode
     *
     * @return $this
     */
    public function setSharedCode(string $sharedCode);

    public function getSharedWithUsers();

    public function addSharedWithUser(UserInterface $user);

    public function removeSharedWithUser(UserInterface $user);
}
