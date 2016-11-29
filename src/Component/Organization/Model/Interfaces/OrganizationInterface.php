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

namespace Component\Organization\Model\Interfaces;

use Component\Core\Model\Interfaces\ResourceInterface;
use Component\Core\Model\Interfaces\ToggleableInterface;

interface OrganizationInterface extends
    ToggleableInterface,
    ResourceInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return OrganizationInterface
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     *
     * @return OrganizationInterface
     */
    public function setCode(string $code);
}