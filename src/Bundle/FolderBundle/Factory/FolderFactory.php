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

namespace Bundle\FolderBundle\Factory;

use Bundle\CoreBundle\Factory\FactoryInterface;
use Bundle\FolderBundle\Entity\Interfaces\FolderInterface;
use Bundle\FolderBundle\Factory\Interfaces\FolderFactoryInterface;

class FolderFactory implements FolderFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * FileFactory constructor.
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return FolderInterface
     */
    public function createNew()
    {
        return $this->factory->createNew();
    }
}
