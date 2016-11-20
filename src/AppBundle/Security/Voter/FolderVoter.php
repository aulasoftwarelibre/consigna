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

use AppBundle\Entity\Folder;
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
        if (!$subject instanceof Folder) {
            return false;
        }

        if (!in_array($attribute, [self::ACCESS, self::CREATE, self::DELETE, self::DOWNLOAD, self::SHARE, self::UPLOAD])) {
            return false;
        }

        return true;
    }

    /**
     * @{@inheritdoc}
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if ($user instanceof User && in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return true;
        }

        switch ($attribute) {
            case self::ACCESS:
            case self::DOWNLOAD:
                if ($user instanceof User) {
                    if ($subject->hasAccess($user)) {
                        return true;
                    }
                } else {
                    if ($this->session->has($subject->getShareCode())) {
                        return true;
                    }
                }
                break;

            case self::DELETE:
            case self::SHARE:
            case self::UPLOAD:
                if ($user instanceof User && $subject->getOwner() == $user) {
                    return true;
                }
                break;

            case self::CREATE:
                if ($user instanceof User) {
                    return true;
                }
                break;
        }

        return false;
    }
}
