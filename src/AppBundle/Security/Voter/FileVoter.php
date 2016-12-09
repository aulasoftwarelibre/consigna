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

namespace AppBundle\Security\Voter;

use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class FileVoter extends Voter
{
    const ACCESS = 'ACCESS';
    const DELETE = 'DELETE';
    const DOWNLOAD = 'DOWNLOAD';
    const SHARE = 'SHARE';

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    protected function supports($attribute, $subject)
    {
        if (!$subject instanceof FileInterface) {
            return false;
        }

        if (!in_array($attribute, [static::ACCESS, static::DELETE, static::DOWNLOAD, static::SHARE])) {
            return false;
        }

        return true;
    }

    /**
     * @param string         $attribute
     * @param FileInterface  $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if (FileInterface::SCAN_STATUS_OK !== $subject->getScanStatus()) {
            return false;
        }

        $user = $token->getUser();

        if ($user instanceof User && in_array('ROLE_ADMIN', $user->getRoles())) {
            return true;
        }

        switch ($attribute) {
            case static::ACCESS:
                if ($user instanceof User || $subject->getOwner()) {
                    return true;
                }
                break;

            case static::DOWNLOAD:
                if ($user instanceof UserInterface) {
                    if ($this->hasAccess($user, $subject)) {
                        return true;
                    }
                } else {
                    if ($this->session->has($subject->getSharedCode())) {
                        return true;
                    }
                }
                break;

            case static::DELETE:
            case static::SHARE:
                if ($user instanceof User && $subject->getOwner() == $user) {
                    return true;
                }
                break;
        }

        return false;
    }

    private function hasAccess(UserInterface $user, FileInterface $file)
    {
        if ($file->getOwner() == $user) {
            return true;
        }

        foreach ($file->getSharedWithUsers() as $sharedWithUser) {
            if ($user == $sharedWithUser) {
                return true;
            }
        }

        return false;
    }
}
