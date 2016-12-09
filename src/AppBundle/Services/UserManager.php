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


namespace AppBundle\Services;

use AppBundle\EventDispatcher\UserEventDispatcher;
use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use FOS\UserBundle\Model\UserInterface;

class UserManager extends BaseUserManager
{
    /**
     * @var UserEventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @inheritDoc
     */
    public function updateUser(UserInterface $user, $andFlush = true)
    {
        $this
            ->eventDispatcher
            ->dispatchOnPreCreatedEvent($user);

        parent::updateUser($user, $andFlush);
    }

    /**
     * @param UserEventDispatcher $eventDispatcher
     */
    public function setEventDispatcher(UserEventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}