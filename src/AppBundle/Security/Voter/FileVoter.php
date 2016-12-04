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

use Component\User\Model\User;
use Component\File\Model\Interfaces\FileInterface;
use Component\User\Model\Interfaces\UserInterface;
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

        if (!in_array($attribute, [self::ACCESS, self::DELETE, self::DOWNLOAD, self::SHARE])) {
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
            case self::ACCESS:
                if ($user instanceof User || $subject->getOwner()) {
                    return true;
                }
                break;

            case self::DOWNLOAD:
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

            case self::DELETE:
            case self::SHARE:
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
