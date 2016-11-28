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

namespace Component\Organization\Services;

use AppBundle\Model\OrganizationInterface;
use Component\Core\Services\ObjectDirector;

class OrganizationManager
{
    /**
     * @var ObjectDirector
     */
    private $organizationDirector;

    public function __construct(ObjectDirector $organizationDirector)
    {
        $this->organizationDirector = $organizationDirector;
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
        $this->organizationDirector->save($organization);

        return $this;
    }

    public function enableOrganization(
        OrganizationInterface $organization
    ) {
        $organization->enable();
        $this->organizationDirector->save($organization);

        return $this;
    }
}
