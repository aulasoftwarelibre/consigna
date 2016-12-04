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

namespace Bundle\FileBundle;

use Bundle\FileBundle\CompilerPass\ConsignaFileMappingBagProvider;
use Bundle\FileBundle\DependencyInjection\ConsignaFileExtension;
use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;

class ConsignaFileBundle extends BaseBundle
{
    public function getCompilerPasses()
    {
        return [
            new MappingCompilerPass(new ConsignaFileMappingBagProvider()),
        ];
    }

    public function getContainerExtension()
    {
        return new ConsignaFileExtension(new ConsignaFileMappingBagProvider());
    }
}
