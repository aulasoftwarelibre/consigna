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

namespace Bundle\FolderBundle\Entity\Interfaces;

use Bundle\CoreBundle\Model\Interfaces\ExpirableInterface;
use Bundle\CoreBundle\Model\Interfaces\OwnableInterface;
use Bundle\CoreBundle\Model\Interfaces\ProtectableInterface;
use Bundle\CoreBundle\Model\Interfaces\ResourceInterface;
use Bundle\CoreBundle\Model\Interfaces\ShareableInterface;
use Bundle\CoreBundle\Model\Interfaces\TaggeableInterface;
use Bundle\CoreBundle\Model\Interfaces\TimestampableInterface;
use Bundle\CoreBundle\Model\Interfaces\TraceableInterface;
use Bundle\FileBundle\Entity\Interfaces\FileInterface;

interface FolderInterface extends
    ExpirableInterface,
    OwnableInterface,
    ProtectableInterface,
    ResourceInterface,
    ShareableInterface,
    TaggeableInterface,
    TimestampableInterface,
    TraceableInterface
{
    public function getName();

    public function setName(string $name);

    public function getDescription();

    public function setDescription(string $description);

    public function getSlug();

    public function setSlug(string $slug);

    public function isPermanent();

    public function setPermanent(bool $permanent);

    public function getFiles();

    public function addFile(FileInterface $file);

    public function removeFile(FileInterface $file);
}
