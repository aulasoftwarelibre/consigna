<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/04/15
 * Time: 22:27.
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

        $menu->addChild($this->container->get('translator')->trans('action.show_all_files'), array('route' => 'homepage'));
        if ($user = $this->container->get('security.token_storage')->getToken()->getUser() != 'anon.') {
            $menu->addChild($this->container->get('translator')->trans('action.show_my_files'), array('route' => 'user_files'));
            $menu->addChild($this->container->get('translator')->trans('action.show_shared_files'), array('route' => 'shared_elements'));
        }

        return $menu;
    }
}
