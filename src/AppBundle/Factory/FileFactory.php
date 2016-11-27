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

namespace AppBundle\Factory;

use AppBundle\Model\FileInterface;

class FileFactory implements FileFactoryInterface
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
     * @return FileInterface
     */
    public function createNew()
    {
        return $this->factory->createNew();
    }
}
