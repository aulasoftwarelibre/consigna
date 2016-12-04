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

namespace Bundle\TagBundle;

use Bundle\TagBundle\CompilerPass\ConsignaTagMappingBagProvider;
use Bundle\TagBundle\DependencyInjection\ConsignaTagExtension;
use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;

class ConsignaTagBundle extends BaseBundle
{
    public function getCompilerPasses()
    {
        return [
            new MappingCompilerPass(new ConsignaTagMappingBagProvider()),
        ];
    }

    public function getContainerExtension()
    {
        return new ConsignaTagExtension(new ConsignaTagMappingBagProvider());
    }
}
