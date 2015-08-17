<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 27/04/15
 * Time: 18:04.
 */
namespace AppBundle\Security\Voter;

use AppBundle\Entity\File;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;

class FileVoter extends AbstractVoter
{
    /**
     * @var
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Return an array of supported classes. This will be called by supportsClass.
     *
     * @return array an array of supported classes, i.e. array('Acme\DemoBundle\Model\Product')
     */
    protected function getSupportedClasses()
    {
        return ['AppBundle\Entity\File'];
    }

    /**
     * Return an array of supported attributes. This will be called by supportsAttribute.
     *
     * @return array an array of supported attributes, i.e. array('CREATE', 'READ')
     */
    protected function getSupportedAttributes()
    {
        return ['ACCESS', 'DOWNLOAD', 'DELETE', 'SHARE'];
    }

    /**
     * Perform a single access check operation on a given attribute, object and (optionally) user
     * It is safe to assume that $attribute and $object's class pass supportsAttribute/supportsClass
     * $user can be one of the following:
     *   a UserInterface object (fully authenticated user)
     *   a string               (anonymously authenticated user).
     *
     * @param string $attribute
     * @param File   $object
     * @param User   $user
     *
     * @return bool
     */
    protected function isGranted($attribute, $object, $user = null)
    {
        if ($object->getScanStatus() != File::SCAN_STATUS_OK) {
            return false;
        }

        if ($user instanceof User && in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return true;
        }

        switch ($attribute) {
            case 'ACCESS':
                if ($user instanceof User || $object->getOwner()) {
                    return true;
                }

            break;

            case 'DOWNLOAD':
                if ($user instanceof User) {
                    if ($object->hasAccess($user)) {
                        return true;
                    }
                } else {
                    if ($this->session->has($object->getShareCode())) {
                        return true;
                    }
                }
            break;

            case 'DELETE':
            case 'SHARE':
                if ($user instanceof User && $object->getOwner() == $user) {
                    return true;
                }
            break;
        }

        return false;
    }
}
