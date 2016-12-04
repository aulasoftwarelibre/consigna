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

namespace Bundle\OrganizationBundle\Services;

use Bundle\CoreBundle\Services\ObjectDirector;
use Bundle\OrganizationBundle\Entity\Interfaces\OrganizationInterface;
use Bundle\OrganizationBundle\EventDispatcher\OrganizationEventDispatcher;

class OrganizationManager
{
    /**
     * @var ObjectDirector
     */
    private $organizationDirector;
    /**
     * @var OrganizationEventDispatcher
     */
    private $organizationEventDispatcher;

    public function __construct(
        ObjectDirector $organizationDirector,
        OrganizationEventDispatcher $organizationEventDispatcher
    ) {
        $this->organizationDirector = $organizationDirector;
        $this->organizationEventDispatcher = $organizationEventDispatcher;
    }

    public function createOrganization(string $name, string $sho)
    {
        $organization = $this->organizationDirector->create()
            ->setName($name)
            ->setCode($sho)
            ->enable()
        ;

        $this->organizationDirector->save($organization);

        return $organization;
    }

    public function updateOrganization(OrganizationInterface $organization, string $name)
    {
        $organization->setName($name);

        $this->organizationDirector->save($organization);

        return $this;
    }

    public function deleteOrganization(OrganizationInterface $organization)
    {
        $this->organizationDirector->remove($organization);

        return $this;
    }

    public function disableOrganization(OrganizationInterface $organization)
    {
        $organization->disable();

        $this
            ->organizationDirector
            ->save($organization);

        $this
            ->organizationEventDispatcher
            ->dispatchOrganizationOnDisabledEvent($organization);

        return $this;
    }

    public function enableOrganization(
        OrganizationInterface $organization
    ) {
        $organization->enable();

        $this
            ->organizationDirector
            ->save($organization);

        $this
            ->organizationEventDispatcher
            ->dispatchOrganizationOnEnabledEvent($organization);

        return $this;
    }
}
