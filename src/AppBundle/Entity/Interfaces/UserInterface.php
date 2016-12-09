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

use AppBundle\Model\Interfaces\ResourceInterface;
use AppBundle\Model\Interfaces\ToggleableInterface;
use FOS\UserBundle\Model\UserInterface as BaseUserInterface;

interface UserInterface extends
    BaseUserInterface,
    ResourceInterface,
    ToggleableInterface
{
    /**
     * @return OrganizationInterface
     */
    public function getOrganization();

    public function setOrganization(OrganizationInterface $organization = null);

    public function getFiles();

    public function addFile(FileInterface $file);

    public function removeFile(FileInterface $file);

    public function getFolders();

    public function addFolder(FolderInterface $folder);

    public function removeFolder(FolderInterface $folder);

    public function getSharedItems();

    public function addSharedItem(ItemInterface $sharedItem);

    public function removeSharedItem(ItemInterface $sharedItem);
}
