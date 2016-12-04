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

namespace Component\Organization\Factory;

use Component\Core\Factory\FactoryInterface;
use Component\Organization\Factory\Interfaces\OrganizationFactoryInterface;
use Component\Organization\Model\Interfaces\OrganizationInterface;

class OrganizationFactory implements OrganizationFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * OrganizationFactory constructor.
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return OrganizationInterface
     */
    public function createNew()
    {
        return $this->factory->createNew();
    }
}
