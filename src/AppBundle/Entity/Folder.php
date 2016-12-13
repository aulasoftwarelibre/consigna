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

namespace AppBundle\Entity;


use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\ItemInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Folder.
 */
class Folder extends Item implements FolderInterface
{
    /**
     * @var ArrayCollection
     */
    protected $items;

    /**
     * Folder constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->items = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ItemInterface $file
     *
     * @return $this
     */
    public function addItem(ItemInterface $file)
    {
        $file->setFolder($this);
        $this->items->add($file);

        return $this;
    }

    /**
     * @param ItemInterface $file
     */
    public function removeItem(ItemInterface $file)
    {
        $file->setFolder(null);
        $this->items->removeElement($file);
    }
}
