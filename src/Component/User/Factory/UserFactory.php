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

namespace Component\User\Factory;

use Component\User\Factory\Interfaces\UserFactoryInterface;
use Component\User\Model\Interfaces\UserInterface;
use Component\Organization\Repository\Interfaces\OrganizationRepositoryInterface;
use Component\Core\Factory\FactoryInterface;

class UserFactory implements UserFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;
    /**
     * @var OrganizationRepositoryInterface
     */
    private $organizationRepository;

    /**
     * FileFactory constructor.
     */
    public function __construct(FactoryInterface $factory, OrganizationRepositoryInterface $organizationRepository)
    {
        $this->factory = $factory;
        $this->organizationRepository = $organizationRepository;
    }

    /**
     * @return UserInterface
     */
    public function createNew()
    {
        return $this->factory->createNew();
    }

    /**
     * @param string $code
     *
     * @return UserInterface
     */
    public function createNewFromOrganization(string $code)
    {
        $organization = $this->organizationRepository->findOneBy(['code' => $code]);
        if (!$organization) {
            throw new \InvalidArgumentException('Organization not found: '.$code);
        }

        $user = $this->createNew();
        $user->setOrganization($organization);

        return $user;
    }
}