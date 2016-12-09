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

interface ItemInterface extends
    ExpirableInterface,
    OwnableInterface,
    TaggeableInterface,
    TimestampableInterface,
    ProtectableInterface,
    ResourceInterface,
    ShareableInterface,
    TraceableInterface
{
    /**
     * @return FolderInterface
     */
    public function getFolder();

    /**
     * @param FolderInterface|null $folder
     *
     * @return $this
     */
    public function setFolder(FolderInterface $folder = null);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ItemInterface
     */
    public function setName(string $name): ItemInterface;

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug(): ?string;

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return ItemInterface
     */
    public function setSlug(string $slug): ItemInterface;

}
