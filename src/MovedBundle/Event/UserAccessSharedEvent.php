<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 14/08/15
 * Time: 04:48.
 */

namespace MovedBundle\Event;

use AppBundle\Model\Interfaces\ShareableInterface;
use Bundle\UserBundle\Entity\Interfaces\UserInterface;
use Symfony\Component\EventDispatcher\Event;

class UserAccessSharedEvent extends Event
{
    /**
     * @var ShareableInterface
     */
    private $object;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * UserAccessSharedEvent constructor.
     *
     * @param ShareableInterface $object
     * @param UserInterface|null $user
     */
    public function __construct(ShareableInterface $object, UserInterface $user = null)
    {
        $this->object = $object;
        $this->user = $user;
    }

    /**
     * @return ShareableInterface
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
