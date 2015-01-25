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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

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
            $user->setPassword($hash['password']);
            $user->setEmail($hash['email']);

            $em-> persist($user); //preparamos la entidad para guardarla en la BD
        }
        $em->flush();
    }

    /**
     * @Given estoy autenticado como :user
     */

    public function autenticadoComo ($usuario)
    {
        $em=$this->getEntityManager();


        $user = $em->getRepository('AppBundle:User')->findOneBy(array('username' => $usuario));
        if (!$user) {
            throw new UsernameNotFoundException('No se encontró el usuario: ' . $usuario);
        }
        $firewall_name = "main";
        $token = new UsernamePasswordToken($user, null, $firewall_name, $user->getRoles());
        $this->getContainer()->get('security.context')->setToken($token);
    }
}