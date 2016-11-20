<?php
/*
 * This file is part of the nodos.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Uco\Bundle\UserBundle\Security;

use AppBundle\Doctrine\ORM\OrganizationRepository;
use AppBundle\Entity\Organization;
use AppBundle\Entity\User;
use AppBundle\Exception\InvalidOrganization;
use FOS\UserBundle\Model\UserManagerInterface;
use Sgomez\Bundle\SSPGuardBundle\Security\Authenticator\SSPGuardAuthenticator;
use Sgomez\Bundle\SSPGuardBundle\SimpleSAMLphp\AuthSourceRegistry;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UcoAuthenticator extends SSPGuardAuthenticator
{
    /**
     * @var UserManagerInterface
     */
    private $userManager;
    /**
     * @var OrganizationRepository
     */
    private $organizationRepository;

    public function __construct(Router $router, AuthSourceRegistry $authSourceRegistry, $authSourceId)
    {
        parent::__construct($router, $authSourceRegistry, $authSourceId);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse($this->router->generate('login'));
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            $user = $userProvider->loadUserByUsername($credentials['mail'][0]);
        } catch (UsernameNotFoundException $e) {
            /** @var Organization $organization */
            $organization = $this->organizationRepository->findOneBy(['code' => $credentials['sHO'][0]]);
            if (!$organization || $organization->getIsEnabled() === false) {
                throw new InvalidOrganization();
            }

            /** @var User $user */
            $user = $this->userManager->createUser();
            $user->setUsername($credentials['mail'][0]);
            $user->setEmail($credentials['mail'][0]);
            $user->setOrganization($organization);
            $user->setPassword('disabled');
            $user->setEnabled(true);

            $this->userManager->updateUser($user);
        }

        return $user;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $this->saveAuthenticationErrorToSession($request, $exception);

        return new RedirectResponse($this->router->generate('login'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $targetPath = $this->getTargetPath($request, $providerKey);

        if (!$targetPath) {
            // Change it to your default target
            $targetPath = $this->router->generate('homepage');
        }

        return new RedirectResponse($targetPath);
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager($userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param OrganizationRepository $organizationRepository
     */
    public function setOrganizationRepository($organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }
}
