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

namespace Component\Core\Model\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ToggleableTrait
{
    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $enabled = true;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return $this
     */
    public function enable()
    {
        $this->setEnabled(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function disable()
    {
        $this->setEnabled(false);

        return $this;
    }
}
