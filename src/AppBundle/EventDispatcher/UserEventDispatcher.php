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


namespace AppBundle\EventDispatcher;


use AppBundle\ConsignaEvents;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Event\UserOnPreCreatedEvent;
use AppBundle\EventDispatcher\Abstracts\AbstractEventDispatcher;

class UserEventDispatcher extends AbstractEventDispatcher
{
    public function dispatchOnPreCreatedEvent(UserInterface $user)
    {
        $event = new UserOnPreCreatedEvent($user);

        $this
            ->eventDispatcher
            ->dispatch(ConsignaEvents::USER_PRE_CREATED, $event);
    }
}