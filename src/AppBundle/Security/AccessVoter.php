<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AccessVoter extends AbstractVoter
{
    private $sessionInterface;

    const ACCESS = 'access';

    protected function getSupportedAttributes()
    {
        return array(self::ACCESS);
    }

    protected function getSupportedClasses()
    {
        return array('AppBundle\Entity\File','AppBundle\Entity\Folder');
    }

    protected function isGranted($attribute, $entity, $user = null)
    {
        if (!$user instanceof UserInterface) {
            if ($this->sessionInterface->has($entity->getSlug())) {
                return true;
            }
        } else {
            if ($entity->hasAccess($user)) {
                return true;
            }

            if ($attribute === self::ACCESS && in_array('ROLE_ADMIN', $user->getRoles(), true)) {
                return true;
            }
        }

        return false;
    }

    public function __construct(SessionInterface $sessionInterface)
    {
        $this->sessionInterface = $sessionInterface;
    }
}
