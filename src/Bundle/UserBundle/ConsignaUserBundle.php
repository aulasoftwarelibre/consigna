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

namespace Bundle\UserBundle;

use Bundle\UserBundle\CompilerPass\ConsignaUserMappingBagProvider;
use Bundle\UserBundle\CompilerPass\FOSUserMappingCompilerPass;
use Bundle\UserBundle\DependencyInjection\ConsignaUserExtension;
use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;

class ConsignaUserBundle extends BaseBundle
{
    public function getCompilerPasses()
    {
        return [
            new FOSUserMappingCompilerPass(),
            new MappingCompilerPass(new ConsignaUserMappingBagProvider()),
        ];
    }

    public function getContainerExtension()
    {
        return new ConsignaUserExtension(new ConsignaUserMappingBagProvider());
    }
}
