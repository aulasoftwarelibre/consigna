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


namespace AppBundle\Event;


use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Model\Interfaces\ShareableInterface;
use Symfony\Component\EventDispatcher\Event;

class ItemOnSharedEvent extends Event
{
    /**
     * @var ShareableInterface
     */
    private $item;
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @inheritDoc
     */
    public function __construct(ShareableInterface $item, ?UserInterface $user)
    {
        $this->item = $item;
        $this->user = $user;
    }

    /**
     * @return ShareableInterface
     */
    public function getItem(): ShareableInterface
    {
        return $this->item;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}