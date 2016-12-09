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

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $translator = $this->container->get('translator');

        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'sidebar-menu']);

        $menu->addChild($translator->trans('action.show_all_files'), ['route' => 'homepage']);
        if ($user = $this->container->get('security.token_storage')->getToken()->getUser() != 'anon.') {
            $menu->addChild($translator->trans('action.show_my_files'), ['route' => 'user_files']);
            $menu->addChild($translator->trans('action.show_shared_files'), ['route' => 'user_files_shared']);
        }

        return $menu;
    }
}
