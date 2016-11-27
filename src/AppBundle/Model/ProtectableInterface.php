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

interface ProtectableInterface
{
    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $password
     */
    public function setPassword(string $password);

    /**
     * @return string
     */
    public function getSalt();

    /**
     * @param string $salt
     */
    public function setSalt(string $salt);

    /**
     * @return string
     */
    public function getPlainPassword();

    /**
     * Set plain password.
     *
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword);

    /**
     * Remove credentials.
     *
     * @return mixed
     */
    public function eraseCredentials();
}
