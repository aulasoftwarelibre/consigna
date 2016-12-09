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

namespace AppBundle\Entity\Interfaces;


interface FolderInterface extends
    ItemInterface
{

    public function getDescription();

    public function setDescription(string $description);

    public function getItems();

    public function addItem(ItemInterface $file);

    public function removeItem(ItemInterface $file);
}
