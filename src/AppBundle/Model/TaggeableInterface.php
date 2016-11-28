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

use Doctrine\Common\Collections\Collection;

interface TaggeableInterface
{
    /**
     * Add a tag.
     *
     * @param TagInterface $tag
     *
     * @return object
     */
    public function addTag(TagInterface $tag);

    /**
     * Remove a tag.
     *
     * @param TagInterface $tag
     */
    public function removeTag(TagInterface $tag);

    /**
     * Get all tags.
     *
     * @return Collection
     */
    public function getTags();
}
