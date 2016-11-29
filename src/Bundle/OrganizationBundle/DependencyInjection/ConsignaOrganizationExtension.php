<?php

namespace Bundle\OrganizationBundle\DependencyInjection;

use Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractExtension;

class ConsignaOrganizationExtension extends AbstractExtension
{
    protected function getConfigFiles($config)
    {
        return [
            'commands',
            'directors',
            'eventDispatcher',
            'factories',
            'repositories',
            'services',
        ];
    }

    protected function getConfigFilesLocation()
    {
        return __DIR__.'/../Resources/config';
    }
}
