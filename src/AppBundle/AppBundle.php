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

namespace AppBundle;

use AppBundle\DependencyInjection\AppExtension;
use AppBundle\DependencyInjection\CompilerPass\ConsignaMappingBagProvider;
use AppBundle\DependencyInjection\CompilerPass\FOSUserMappingCompilerPass;
use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;

class AppBundle extends BaseBundle
{
    public function getCompilerPasses()
    {
        return [
            new FOSUserMappingCompilerPass(),
            new MappingCompilerPass(new ConsignaMappingBagProvider()),
        ];
    }

    public function getContainerExtension()
    {
        return new AppExtension(new ConsignaMappingBagProvider());
    }
}
