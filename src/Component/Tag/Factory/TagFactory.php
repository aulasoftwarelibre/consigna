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

namespace Component\Tag\Factory;

use Component\Core\Factory\FactoryInterface;
use Component\Tag\Factory\Interfaces\TagFactoryInterface;
use Component\Tag\Model\Interfaces\TagInterface;

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