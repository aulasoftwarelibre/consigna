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

namespace Bundle\TagBundle\Factory;

use Bundle\TagBundle\Entity\Intefaces\TagInterface;
use Bundle\TagBundle\Factory\Interfaces\TagFactoryInterface;
use Component\Core\Factory\FactoryInterface;

class TagFactory implements TagFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return TagInterface
     */
    public function createNew()
    {
        return $this->factory->createNew();
    }
}
