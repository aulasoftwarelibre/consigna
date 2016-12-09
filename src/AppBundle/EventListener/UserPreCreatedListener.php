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


namespace AppBundle\EventListener;


use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\Exception\OrganizationNotFound;
use AppBundle\Repository\Interfaces\OrganizationRepositoryInterface;
use FOS\UserBundle\Event\UserEvent;

class UserPreCreatedListener
{
    /**
     * @var OrganizationRepositoryInterface
     */
    private $organizationRepository;

    /**
     * @inheritDoc
     */
    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function onPreCreatedUser(UserEvent $event)
    {
        $user = $event->getUser();

        if ($user instanceof UserInterface && !$user->getOrganization()) {
            $username = $event->getUser()->getUsername();
            if (!preg_match('/@(?<code>[^@]+)$/', $username, $matches)) {
                throw new \InvalidArgumentException('Invalid username: '.$username);
            }

            $organization = $this->organizationRepository->findOneBy(['code' => $matches['code']]);
            if (!$organization) {
                throw new OrganizationNotFound($matches['code']);
            }

            $user->setOrganization($organization);
        }
    }

}