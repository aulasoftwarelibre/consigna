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


namespace AppBundle\Repository\Interfaces;


use AppBundle\Entity\Interfaces\ItemInterface;
use Doctrine\Common\Persistence\ObjectRepository;

interface ItemRepositoryInterface extends ObjectRepository
{
    /**
     * Returns all active items.
     *
     * @return ItemInterface[]|null
     */
    public function findAllActiveBy(array $criteria = [], array $orderBy = ['o.name', 'ASC']): ?array;

    /***
     * Find one item by its slug.
     *
     * @param array $args
     *
     * @return ItemInterface|null
     */
    public function findOneActiveBy(array $args): ?ItemInterface;
}