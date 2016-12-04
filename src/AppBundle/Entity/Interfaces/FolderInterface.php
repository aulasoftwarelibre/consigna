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

use AppBundle\Model\Interfaces\ExpirableInterface;
use AppBundle\Model\Interfaces\OwnableInterface;
use AppBundle\Model\Interfaces\ProtectableInterface;
use AppBundle\Model\Interfaces\ResourceInterface;
use AppBundle\Model\Interfaces\ShareableInterface;
use AppBundle\Model\Interfaces\TaggeableInterface;
use AppBundle\Model\Interfaces\TimestampableInterface;
use AppBundle\Model\Interfaces\TraceableInterface;

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
