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

namespace Bundle\OrganizationBundle;

use Bundle\OrganizationBundle\CompilerPass\ConsignaOrganizationMappingBagProvider;
use Bundle\OrganizationBundle\DependencyInjection\ConsignaOrganizationExtension;
use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;

class ConsignaOrganizationBundle extends BaseBundle
{
    public function getCompilerPasses()
    {
        return [
            new MappingCompilerPass(new ConsignaOrganizationMappingBagProvider()),
        ];
    }

    public function getContainerExtension()
    {
        return new ConsignaOrganizationExtension(new ConsignaOrganizationMappingBagProvider());
    }
}
