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

namespace Component\User\Repository;

use Component\User\Repository\Interfaces\GroupRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class GroupRepository extends EntityRepository implements GroupRepositoryInterface
{
}
