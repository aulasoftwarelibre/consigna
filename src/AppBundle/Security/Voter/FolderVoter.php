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

use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class FolderVoter extends Voter
{
    const ACCESS = 'ACCESS';
    const CREATE = 'CREATE';
    const DELETE = 'DELETE';
    const DOWNLOAD = 'DOWNLOAD';
    const SHARE = 'SHARE';
    const UPLOAD = 'UPLOAD';

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @{@inheritdoc}
     */
    protected function supports($attribute, $subject)
    {
        if (!$subject instanceof FolderInterface) {
            return false;
        }

        if (!in_array($attribute, [static::ACCESS, static::CREATE, static::DELETE, static::DOWNLOAD, static::SHARE, static::UPLOAD])) {
            return false;
        }

        return true;
    }

    /**
     * @param string          $attribute
     * @param FolderInterface $subject
     * @param TokenInterface  $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if ($user instanceof User && in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return true;
        }

        switch ($attribute) {
            case static::ACCESS:
            case static::DOWNLOAD:
                if ($user instanceof User) {
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
            case static::UPLOAD:
                if ($user instanceof User && $subject->getOwner() == $user) {
                    return true;
                }
                break;

            case static::CREATE:
                if ($user instanceof User) {
                    return true;
                }
                break;
        }

        return false;
    }

    private function hasAccess(UserInterface $user, FolderInterface $folder)
    {
        if ($folder->getOwner() == $user) {
            return true;
        }

        foreach ($folder->getSharedWithUsers() as $member) {
            if ($user == $member) {
                return true;
            }
        }

        return false;
    }
}
