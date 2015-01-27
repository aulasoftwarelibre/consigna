<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 18/01/15
 * Time: 17:58
 */
namespace AppBundle\Behat;

use AppBundle\Entity\User;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\EventDispatcher\EventDispatcher;

class UserContext extends CoreContext
{
    /**
     * @Given existing users:
     */

    public function createList (TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode as $hash){
            $user = new User();
            $user->setUsername($hash['username']);
            $user->setPlainPassword($hash['plainPassword']);
            $user->setEmail($hash['email']);
            $user->setEnabled($hash['enabled']);

            $em-> persist($user);
        }
        $em->flush();
    }

    /**
     * @Given I am authenticated as :username
     */
    public function authenticatedAs ($username)
    {
        $this->getSession()->visit($this->generatePageUrl('fos_user_security_login'));
        $this->fillField('username', $username);
        $this->fillField('password', 'paquete');
        $this->pressButton('submit');
    }
}