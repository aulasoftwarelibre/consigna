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

namespace AppBundle\Event\Abstracts;

use AppBundle\Entity\Interfaces\OrganizationInterface;
use Symfony\Component\EventDispatcher\Event;

abstract class AbstractOrganizationEvent extends Event
{
    /**
     * @var OrganizationInterface
     */
    private $organization;

    public function __construct(OrganizationInterface $organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return OrganizationInterface
     */
    public function getOrganization()
    {
        return $this->organization;
    }
}
