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

namespace Bundle\CoreBundle\CompilerPass;

use Mmoreram\SimpleDoctrineMapping\CompilerPass\Abstracts\AbstractMappingCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MappingCompilerPass extends AbstractMappingCompilerPass
{
    public function process(ContainerBuilder $container)
    {
        $this
            ->addEntityMapping(
                $container,
                'default',
                'AppBundle\Entity\File',
                '@ConsignaCoreBundle/Resources/config/doctrine/File.orm.xml'
            )
            ->addEntityMapping(
                $container,
                'default',
                'AppBundle\Entity\Group',
                '@ConsignaCoreBundle/Resources/config/doctrine/Group.orm.xml'
            )
            ->addEntityMapping(
                $container,
                'default',
                'FOS\UserBundle\Model\Group',
                '@FOSUserBundle/Resources/config/doctrine-mapping/Group.orm.xml'
            )
            ->addEntityMapping(
                $container,
                'default',
                'AppBundle\Entity\Tag',
                '@ConsignaCoreBundle/Resources/config/doctrine/Tag.orm.xml'
            )
            ->addEntityMapping(
                $container,
                'default',
                'AppBundle\Entity\User',
                '@ConsignaCoreBundle/Resources/config/doctrine/User.orm.xml'
            )
            ->addEntityMapping(
                $container,
                'default',
                'FOS\UserBundle\Model\User',
                '@FOSUserBundle/Resources/config/doctrine-mapping/User.orm.xml'
            );
    }
}
