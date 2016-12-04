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

namespace Bundle\CoreBundle\Model\Traits;

trait ProtectableTrait
{
    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     *
     * @return $this
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get plain password.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set plain password.
     *
     * @param string $plainPassword
     *
     * @return $this
     */
    public function setPlainPassword(string $plainPassword = null)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Remove credentials.
     */
    public function eraseCredentials()
    {
        $this->setPlainPassword(null);
    }
}
