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
use Doctrine\Common\Annotations\AnnotationRegistry;
use Mmoreram\BaseBundle\BaseBundle;

class AppBundle extends BaseBundle
{
    /**
     * @inheritDoc
     */
    public function boot()
    {
        $kernel = $this
            ->container
            ->get('kernel');

        AnnotationRegistry::registerFile($kernel
            ->locateResource('@AppBundle/Doctrine/Annotation/Filter.php')
        );
    }


    public function getContainerExtension()
    {
        return new AppExtension();
    }
}
