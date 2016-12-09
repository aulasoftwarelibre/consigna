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

namespace AppBundle\EventDispatcher;

use AppBundle\ConsignaEvents;
use AppBundle\Entity\Interfaces\OrganizationInterface;
use AppBundle\Event\OrganizationOnDisabledEvent;
use AppBundle\Event\OrganizationOnEnabledEvent;
use AppBundle\EventDispatcher\Abstracts\AbstractEventDispatcher;

class OrganizationEventDispatcher extends AbstractEventDispatcher
{
    public function dispatchOrganizationOnEnabledEvent(OrganizationInterface $organization)
    {
        $event = new OrganizationOnEnabledEvent($organization);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::ORGANIZATION_ENABLED, $event);

        return $this;
    }

    public function dispatchOrganizationOnDisabledEvent(OrganizationInterface $organization)
    {
        $event = new OrganizationOnDisabledEvent($organization);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::ORGANIZATION_DISABLED, $event);

        return $this;
    }
}
