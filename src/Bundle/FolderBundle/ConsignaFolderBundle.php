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

namespace Bundle\FolderBundle;

use Bundle\FolderBundle\CompilerPass\ConsignaFolderMappingBagProvider;
use Bundle\FolderBundle\DependencyInjection\ConsignaFolderExtension;
use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;

class ConsignaFolderBundle extends BaseBundle
{
    public function getCompilerPasses()
    {
        return [
            new MappingCompilerPass(new ConsignaFolderMappingBagProvider()),
        ];
    }

    public function getContainerExtension()
    {
        return new ConsignaFolderExtension(new ConsignaFolderMappingBagProvider());
    }
}
