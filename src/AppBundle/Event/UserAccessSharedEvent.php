<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 14/08/15
 * Time: 04:48.
 */
namespace AppBundle\Event;

use AppBundle\Entity\User;
use AppBundle\Model\FileInterface;
use Symfony\Component\EventDispatcher\Event;

class UserAccessSharedEvent extends Event
{
    /**
     * @var FileInterface
     */
    private $object;

    /**
     * @var User
     */
    private $user;

    /**
     * UserAccessSharedEvent constructor.
     *
     * @param FileInterface $object
     * @param User|null     $user
     */
    public function __construct(FileInterface $object, User $user = null)
    {
        $this->object = $object;
        $this->user = $user;
    }

    /**
     * @return FileInterface
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
