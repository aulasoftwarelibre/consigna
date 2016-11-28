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

namespace AppBundle\Model;

use Component\Core\Model\Interfaces\ResourceInterface;

interface TagInterface extends ResourceInterface
{
    public function getName();

    public function setName(string $name);

    public function addFile(FileInterface $files);

    public function removeFile(FileInterface $files);

    public function getFiles();

    public function addFolder(FolderInterface $folders);

    public function removeFolder(FolderInterface $folders);

    public function getFolders();
}
