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

interface TimestampableInterface
{
    public function getCreatedAt();

    public function setCreatedAt(\DateTime $createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt(\DateTime $updatedAt);
}
