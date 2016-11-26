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


use AppBundle\Entity\File;
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
        if (!$subject instanceof File) {
            return false;
        }

        if (!in_array($attribute, [self::ACCESS, self::DELETE, self::DOWNLOAD, self::SHARE])) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param File $subject
     * @param TokenInterface $token
     * @return boolean
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        dump($subject);
        if (File::SCAN_STATUS_OK !== $subject->getScanStatus()) {
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
                if ($user instanceof User && $subject->getOwner() == $user) {
                    return true;
                }
                break;
        }

        return false;
    }

}