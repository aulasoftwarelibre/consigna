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
use Symfony\Component\Security\Core\SecurityContext;


class UserContext extends CoreContext
{
    /**
     * @Given existen los usuarios:
     */

    public function crearLista (TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode as $hash){
            $user = new User();
            $user->setUsername($hash['username']);
            $user->setPlainPassword($hash['plainPassword']);
            $user->setEmail($hash['email']);
            $user->setEnabled($hash['enabled']);


            $em-> persist($user); //preparamos la entidad para guardarla en la BD
        }
        $em->flush();
    }

    /**
     * @Given estoy autenticado como :username
     */
    public function autenticadoComo ($username)
    {
        $this->getSession()->visit($this->generatePageUrl('fos_user_security_login'));
        $this->fillField('username', $username);
        $this->fillField('password', 'paquete');
        $this->pressButton('submit');
    }
}