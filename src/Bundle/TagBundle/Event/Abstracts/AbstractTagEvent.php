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

namespace Bundle\TagBundle\Event\Abstracts;

use Bundle\TagBundle\Entity\Intefaces\TagInterface;
use Symfony\Component\EventDispatcher\Event;

class AbstractTagEvent extends Event
{
    /**
     * @var TagInterface
     */
    private $tag;

    public function __construct(TagInterface $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return TagInterface
     */
    public function getTag(): TagInterface
    {
        return $this->tag;
    }
}
