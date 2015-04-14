<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class DeleteVoter extends AbstractVoter
{
    const DELETE = 'delete';

    protected function getSupportedAttributes()
    {
        return array(self::DELETE);
    }

    protected function getSupportedClasses()
    {
        return array('AppBundle\Entity\File','AppBundle\Entity\Folder');
    }

    protected function isGranted($attribute, $entity, $user = null)
    {
        if ($user instanceof UserInterface) {
            if ($entity->getUser() === $user) {
                return true;
            }
            if ($attribute === self::DELETE && in_array('ROLE_ADMIN', $user->getRoles(), true)) {
                return true;
            }
        }

        return false;
    }
}
