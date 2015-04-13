<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class CreateVoter extends AbstractVoter
{
    const CREATE = 'create';

    protected function getSupportedAttributes()
    {
        return array(self::CREATE);
    }

    protected function getSupportedClasses()
    {
        return array('AppBundle\Entity\Folder');
    }

    protected function isGranted($attribute, $entity, $user = null)
    {
        if ($user instanceof UserInterface) {
            return true;
        }
        return false;
    }
}
