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

namespace Component\Organization\EventDispatcher;

use Component\Core\EventDispatcher\Abstracts\AbstractEventDispatcher;
use Component\Organization\ConsignaOrganizationEvents;
use Component\Organization\Event\OrganizationOnDisabledEvent;
use Component\Organization\Event\OrganizationOnEnabledEvent;
use Component\Organization\Model\Interfaces\OrganizationInterface;

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
