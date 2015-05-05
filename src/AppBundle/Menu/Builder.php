<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/04/15
 * Time: 22:27
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'sidebar-menu'));

        $menu->addChild('All files', array('route' => 'homepage'));
        if($user = $this->container->get('security.token_storage')->getToken()->getUser()!='anon.'){
            $menu->addChild('My files', array('route' => 'user_files'));
            $menu->addChild('Shared with me', array('route' => 'shared_elements'));
        }

        return $menu;
    }
}