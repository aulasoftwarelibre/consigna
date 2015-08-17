<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 02/08/15
 * Time: 23:14.
 */
namespace AppBundle\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Mink\Exception\ElementNotFoundException;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\User\UserInterface;

class DefaultContext extends RawMinkContext implements Context, KernelAwareContext
{
    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * Actions.
     *
     * @var array
     */
    protected $actions = array(
        'viewing' => 'show',
        'creation' => 'create',
        'editing' => 'update',
        'building' => 'build',
    );

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @BeforeScenario
     */
    public function purgeDatabase(BeforeScenarioScope $scope)
    {
        $entityManager = $this->getService('doctrine.orm.entity_manager');
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);

        $isMySqlDriver = $entityManager->getConnection()->getDriver() instanceof PDOMySqlDriver;
        if ($isMySqlDriver) {
            $entityManager->getConnection()->executeUpdate('SET foreign_key_checks = 0;');
        }

        $purger = new ORMPurger($entityManager);
        $purger->purge();

        if ($isMySqlDriver) {
            $entityManager->getConnection()->executeUpdate('SET foreign_key_checks = 1;');
        }

        $entityManager->clear();
    }

    /**
     * Find one resource by name.
     *
     * @param string $type
     * @param string $name
     *
     * @return object
     */
    protected function findOneByName($type, $name)
    {
        return $this->findOneBy($type, array('name' => trim($name)));
    }

    /**
     * Find one resource by criteria.
     *
     * @param string $type
     * @param array  $criteria
     *
     * @return object
     *
     * @throws \InvalidArgumentException
     */
    protected function findOneBy($type, array $criteria)
    {
        $resource = $this
            ->getRepository($type)
            ->findOneBy($criteria)
        ;

        if (null === $resource) {
            throw new \InvalidArgumentException(
                sprintf('%s for criteria "%s" was not found.', str_replace('_', ' ', ucfirst($type)), serialize($criteria))
            );
        }

        return $resource;
    }

    /**
     * Get repository by resource name.
     *
     * @param string $resource
     *
     * @return RepositoryInterface
     */
    protected function getRepository($resource)
    {
        return $this->getService($this->applicationName.'.repository.'.$resource);
    }

    /**
     * Get entity manager.
     *
     * @return ObjectManager
     */
    protected function getEntityManager()
    {
        return $this->getService('doctrine')->getManager();
    }

    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * Generate page url.
     * This method uses simple convention where page argument is prefixed
     * with the application name and used as route name passed to router generate method.
     *
     * @param object|string $page
     * @param array         $parameters
     *
     * @return string
     */
    protected function generatePageUrl($page, array $parameters = array())
    {
        if (is_object($page)) {
            return $this->generateUrl($page, $parameters);
        }

        $route = str_replace(' ', '_', trim($page));
        $routes = $this->getContainer()->get('router')->getRouteCollection();

        if (null === $routes->get($route)) {
            $route = $this->applicationName.'_'.$route;
        }

        if (null === $routes->get($route)) {
            $route = str_replace($this->applicationName.'_', $this->applicationName.'_backend_', $route);
        }

        $route = str_replace(array_keys($this->actions), array_values($this->actions), $route);
        $route = str_replace(' ', '_', $route);

        return $this->generateUrl($route, $parameters);
    }

    /**
     * Get current user instance.
     *
     * @return null|UserInterface
     *
     * @throws \Exception
     */
    protected function getUser()
    {
        $token = $this->getSecurityContext()->getToken();

        if (null === $token) {
            throw new \Exception('No token found in security context.');
        }

        return $token->getUser();
    }

    /**
     * Get security context.
     *
     * @return TokenStorage
     */
    protected function getSecurityContext()
    {
        return $this->getContainer()->get('security.token_storage');
    }

    /**
     * Generate url.
     *
     * @param string  $route
     * @param array   $parameters
     * @param Boolean $absolute
     *
     * @return string
     */
    protected function generateUrl($route, array $parameters = array(), $absolute = false)
    {
        return $this->locatePath($this->getService('router')->generate($route, $parameters, $absolute));
    }

    /**
     * Presses button with specified id|name|title|alt|value.
     *
     * @param string $button
     *
     * @throws ElementNotFoundException
     */
    protected function pressButton($button)
    {
        $this->getSession()->getPage()->pressButton($this->fixStepArgument($button));
    }

    /**
     * Clicks link with specified id|title|alt|text.
     *
     * @param string $link
     *
     * @throws ElementNotFoundException
     */
    protected function clickLink($link)
    {
        $this->getSession()->getPage()->clickLink($this->fixStepArgument($link));
    }

    /**
     * Fills in form field with specified id|name|label|value.
     *
     * @param string $field
     * @param string $value
     *
     * @throws ElementNotFoundException
     */
    protected function fillField($field, $value)
    {
        $this->getSession()->getPage()->fillField(
            $this->fixStepArgument($field),
            $this->fixStepArgument($value)
        );
    }

    /**
     * Selects option in select field with specified id|name|label|value.
     *
     * @param string $select
     * @param string $option
     *
     * @throws ElementNotFoundException
     */
    protected function selectOption($select, $option)
    {
        $this->getSession()->getPage()->selectFieldOption(
            $this->fixStepArgument($select),
            $this->fixStepArgument($option)
        );
    }

    /**
     * Returns fixed step argument (with \\" replaced back to ").
     *
     * @param string $argument
     *
     * @return string
     */
    protected function fixStepArgument($argument)
    {
        return str_replace('\\"', '"', $argument);
    }
}
