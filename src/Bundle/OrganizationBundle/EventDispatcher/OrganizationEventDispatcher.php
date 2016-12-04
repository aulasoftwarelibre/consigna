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

namespace Bundle\OrganizationBundle\EventDispatcher;

use Bundle\CoreBundle\EventDispatcher\Abstracts\AbstractEventDispatcher;
use Bundle\OrganizationBundle\ConsignaOrganizationEvents;
use Bundle\OrganizationBundle\Entity\Interfaces\OrganizationInterface;
use Bundle\OrganizationBundle\Event\OrganizationOnDisabledEvent;
use Bundle\OrganizationBundle\Event\OrganizationOnEnabledEvent;

class OrganizationEventDispatcher extends AbstractEventDispatcher
{
    public function dispatchOrganizationOnEnabledEvent(OrganizationInterface $organization)
    {
        $event = new OrganizationOnEnabledEvent($organization);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaOrganizationEvents::ORGANIZATION_ENABLED, $event);

        return $this;
    }

    public function dispatchOrganizationOnDisabledEvent(OrganizationInterface $organization)
    {
        $event = new OrganizationOnDisabledEvent($organization);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaOrganizationEvents::ORGANIZATION_DISABLED, $event);

        return $this;
    }
}
